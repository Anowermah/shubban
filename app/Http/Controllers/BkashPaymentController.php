<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BkashPaymentController extends Controller
{
    protected $baseUrl;
    protected $appKey;
    protected $appSecret;
    protected $username;
    protected $password;
    
    public function __construct()
    {
        $this->baseUrl = config('bkash.sandbox') 
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta'
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta';
            
        $this->appKey = config('bkash.app_key');
        $this->appSecret = config('bkash.app_secret');
        $this->username = config('bkash.username');
        $this->password = config('bkash.password');
    }

    public function getToken()
    {
        try {
            $response = Http::withHeaders([
                'username' => $this->username,
                'password' => $this->password
            ])->post($this->baseUrl . '/tokenized/checkout/token/grant', [
                'app_key' => $this->appKey,
                'app_secret' => $this->appSecret
            ]);

            \Log::info('bKash token response: ' . json_encode($response->json()));
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('bKash token error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createPayment(Request $request)
    {
        $tokenData = $this->getToken();
        if (!isset($tokenData['id_token'])) {
            return response()->json(['error' => 'Could not get token'], 500);
        }
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => $tokenData['id_token'],
            'X-APP-Key' => $this->appKey
        ])->post($this->baseUrl . '/tokenized/checkout/create', [
            'mode' => '0011',
            'payerReference' => 'donor',
            'callbackURL' => url('/donate/bkash/callback'),
            'amount' => $request->amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => uniqid('inv_')
        ]);
        return $response->json();
    }

    public function executePayment(Request $request)
    {
        $paymentID = $request->paymentID ?? session('bkash_payment_id');
        if (!$paymentID) {
            return response()->json(['error' => 'No paymentID'], 400);
        }
        $tokenData = $this->getToken();
        if (!isset($tokenData['id_token'])) {
            return response()->json(['error' => 'Could not get token'], 500);
        }
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => $tokenData['id_token'],
            'X-APP-Key' => $this->appKey
        ])->post($this->baseUrl . '/tokenized/checkout/execute', [
            'paymentID' => $paymentID
        ]);
        return $response->json();
    }

    public function queryPayment(Request $request)
    {
        try {
            $token = $this->getToken();

            if (!isset($token['id_token'])) {
                return response()->json(['error' => 'Could not get token'], 500);
            }

            $response = Http::withHeaders([
                'Authorization' => $token['id_token'],
                'X-APP-Key' => $this->appKey
            ])->get($this->baseUrl . '/tokenized/checkout/payment/status', [
                'paymentID' => $request->paymentID
            ]);

            \Log::info('bKash query payment response: ' . json_encode($response->json()));
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('bKash query payment error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
