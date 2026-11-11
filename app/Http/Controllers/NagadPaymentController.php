<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NagadPaymentController extends Controller
{
    protected $baseUrl;
    protected $merchantId;
    protected $merchantNumber;
    protected $publicKey;
    protected $privateKey;

    public function __construct()
    {
        $this->baseUrl = config('payment.nagad.sandbox') 
            ? 'http://sandbox.nagad.com.bd/api/dfs'
            : 'https://api.nagad.com.bd/api/dfs';
        
        $this->merchantId = config('payment.nagad.merchant_id');
        $this->merchantNumber = config('payment.nagad.merchant_number');
        $this->publicKey = config('payment.nagad.public_key');
        $this->privateKey = config('payment.nagad.private_key');
    }

    public function createPayment(Request $request)
    {
        try {
            $amount = $request->amount;
            $orderId = 'DON' . time();
            
            // Generate challenge
            $sensitiveData = [
                'merchantId' => $this->merchantId,
                'datetime' => date('YmdHis'),
                'orderId' => $orderId,
                'challenge' => bin2hex(random_bytes(32))
            ];

            // Encrypt sensitive data
            $encryptedData = $this->encryptSensitiveData(json_encode($sensitiveData));
            
            // Initial API call
            $response = Http::post($this->baseUrl . '/check-out/initialize/' . $this->merchantId . '/' . $orderId, [
                'dateTime' => date('YmdHis'),
                'sensitiveData' => $encryptedData,
                'signature' => $this->generateSignature($encryptedData)
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'Success') {
                    // Create payment request
                    $paymentRequest = [
                        'merchantId' => $this->merchantId,
                        'orderId' => $orderId,
                        'amount' => $amount,
                        'currency' => 'BDT',
                        'challenge' => $sensitiveData['challenge'],
                        'callbackURL' => config('payment.nagad.callback_url')
                    ];

                    $encryptedPayment = $this->encryptSensitiveData(json_encode($paymentRequest));
                    
                    // Complete payment request
                    $completeResponse = Http::post($data['callbackUrl'], [
                        'sensitiveData' => $encryptedPayment,
                        'signature' => $this->generateSignature($encryptedPayment),
                        'merchantCallbackURL' => config('payment.nagad.callback_url')
                    ]);

                    if ($completeResponse->successful()) {
                        $result = $completeResponse->json();
                        
                        if ($result['status'] === 'Success') {
                            return response()->json([
                                'success' => true,
                                'redirectUrl' => $result['callbackUrl']
                            ]);
                        }
                    }
                }
            }

            Log::error('Nagad payment creation failed', [
                'response' => $response->json(),
                'order_id' => $orderId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Nagad payment error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $data = $this->decryptCallbackData($request->payment_ref_id);
            
            if ($data && isset($data['status']) && $data['status'] === 'Success') {
                // Update donation status
                $orderId = $data['orderId'];
                $orderNumber = substr($orderId, 3); // Remove 'DON' prefix
                
                $donation = Donation::where('id', $orderNumber)->first();
                
                if ($donation) {
                    $donation->update([
                        'status' => 'completed',
                        'transaction_id' => $data['payment_ref_id']
                    ]);

                    return redirect()->route('donate.success')
                        ->with('message', 'আপনার দান সফলভাবে সম্পন্ন হয়েছে।');
                }
            }

            return redirect()->route('donate.failed')
                ->with('error', 'পেমেন্ট প্রসেস করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।');

        } catch (\Exception $e) {
            Log::error('Nagad callback error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('donate.failed')
                ->with('error', 'পেমেন্ট প্রসেস করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।');
        }
    }

    protected function encryptSensitiveData($data)
    {
        $publicKey = openssl_pkey_get_public($this->publicKey);
        openssl_public_encrypt($data, $encrypted, $publicKey);
        return base64_encode($encrypted);
    }

    protected function decryptCallbackData($data)
    {
        $privateKey = openssl_pkey_get_private($this->privateKey);
        $decrypted = '';
        openssl_private_decrypt(base64_decode($data), $decrypted, $privateKey);
        return json_decode($decrypted, true);
    }

    protected function generateSignature($data)
    {
        $privateKey = openssl_pkey_get_private($this->privateKey);
        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        return base64_encode($signature);
    }
}
