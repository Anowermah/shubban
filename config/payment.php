<?php

return [
    'numbers' => [
        'bkash' => '01XXXXXXXXX',
        'nagad' => '01XXXXXXXXX',
        'rocket' => '01XXXXXXXXX'
    ],
    'nagad' => [
        'sandbox' => env('NAGAD_SANDBOX', true),
        'merchant_id' => env('NAGAD_MERCHANT_ID'),
        'merchant_number' => env('NAGAD_MERCHANT_NUMBER'),
        'public_key' => env('NAGAD_PUBLIC_KEY'),
        'private_key' => env('NAGAD_PRIVATE_KEY'),
        'callback_url' => env('APP_URL') . '/nagad/callback',
    ],
    'bkash' => [
        'sandbox' => env('BKASH_SANDBOX', true),
        'app_key' => env('BKASH_APP_KEY', ''),
        'app_secret' => env('BKASH_APP_SECRET', ''),
        'username' => env('BKASH_USERNAME', ''),
        'password' => env('BKASH_PASSWORD', ''),
        'merchant_number' => env('BKASH_MERCHANT_NUMBER', '01765812261'),
    ]
];
