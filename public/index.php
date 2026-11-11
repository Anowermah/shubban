<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Environment & Dependencies Health Check
|--------------------------------------------------------------------------
|
| Display friendly guidance instead of blank 500 error if vendor or .env is missing.
|
*/
if (!file_exists(__DIR__.'/../vendor/autoload.php')) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html lang="bn"><head><meta charset="utf-8"><title>Setup Required - Shubban</title><style>body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;padding:40px 20px;background:#f1f5f9;color:#1e293b;line-height:1.7}.card{max-width:680px;margin:0 auto;background:#fff;border-radius:16px;padding:36px;box-shadow:0 10px 30px rgba(0,0,0,0.08);border-top:6px solid #ef4444}h2{color:#ef4444;margin-top:0;font-size:22px}code{background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:14px;color:#be123c;border:1px solid #e2e8f0}.step{background:#f8fafc;border-left:4px solid #0c4b36;padding:14px 18px;margin:14px 0;border-radius:0 8px 8px 0}strong{color:#0c4b36}</style></head><body><div class="card"><h2>⚠️ Vendor ফোল্ডার অনুপস্থিত (Dependencies Missing)</h2><p>Git থেকে ক্লোন করার পর সার্ভারে <code>vendor</code> ফোল্ডারটি প্রস্তুত করা প্রয়োজন:</p><div class="step"><strong>পদ্ধতি ১ (সবচেয়ে সহজ):</strong> লোকাল পিসির <code>vendor</code> ফোল্ডারটি ZIP করে cPanel File Manager দিয়ে সাব-ডোমেইনের রুটে আপলোড করে <b>Extract</b> (আনজিপ) করে দিন।</div><div class="step"><strong>পদ্ধতি ২:</strong> cPanel Terminal অথবা SSH-এ সাব-ডোমেইন ডিরেক্টরিতে গিয়ে <code>composer install --no-dev --optimize-autoloader</code> কমান্ড চালান।</div></div></body></html>';
    exit;
}

if (!file_exists(__DIR__.'/../.env')) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html lang="bn"><head><meta charset="utf-8"><title>.env Setup Required - Shubban</title><style>body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;padding:40px 20px;background:#f1f5f9;color:#1e293b;line-height:1.7}.card{max-width:680px;margin:0 auto;background:#fff;border-radius:16px;padding:36px;box-shadow:0 10px 30px rgba(0,0,0,0.08);border-top:6px solid #f59e0b}h2{color:#d97706;margin-top:0;font-size:22px}code{background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:14px;color:#be123c;border:1px solid #e2e8f0}.step{background:#f8fafc;border-left:4px solid #0c4b36;padding:14px 18px;margin:14px 0;border-radius:0 8px 8px 0}strong{color:#0c4b36}</style></head><body><div class="card"><h2>⚠️ .env কনফিগারেশন ফাইল প্রয়োজন</h2><p>সাব-ডোমেইন ডিরেক্টরিতে <code>.env.example</code> ফাইলটিকে কপি বা রিনেম করে <code>.env</code> তৈরি করুন এবং cPanel ডাটাবেজের তথ্য বসিয়ে দিন।</p><div class="step">টার্মিনালে <code>php artisan key:generate</code> এবং <code>php artisan migrate --force</code> রান করে নিবেন।</div></div></body></html>';
    exit;
}

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
