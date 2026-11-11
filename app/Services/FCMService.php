<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FCMService
{
    public static function send($token, $notification)
    {
        Http::acceptJson()->withToken(config('fcm.server_key'))
            ->post('https://fcm.googleapis.com/fcm/send', [
                'to' => $token,
                'notification' => $notification,
            ]);
    }

    public static function sendToTopic($topic, $notification)
    {
        Http::acceptJson()->withToken(config('fcm.server_key'))
            ->post('https://fcm.googleapis.com/fcm/send', [
                'to' => '/topics/' . $topic,
                'notification' => $notification,
            ]);
    }
}
