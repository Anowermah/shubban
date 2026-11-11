<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Cloud Messaging Credentials
    |--------------------------------------------------------------------------
    |
    | Please add your Firebase project credentials json file to storage/app/firebase
    | and update the following information
    |
    */
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS', storage_path('app/firebase/firebase-credentials.json')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Firebase Cloud Messaging Default Options
    |--------------------------------------------------------------------------
    |
    | Default options for Firebase Cloud Messaging
    |
    */
    'default' => [
        'priority' => 'high',
        'timeToLive' => 0,
    ],
];
