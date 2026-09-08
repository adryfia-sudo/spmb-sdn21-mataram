<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'nextcloud' => [
        'webdav_url' => env('NEXTCLOUD_WEBDAV_URL'),
        'username' => env('NEXTCLOUD_WEBDAV_USERNAME'),
        'password' => env('NEXTCLOUD_WEBDAV_PASSWORD'),
        'path' => env('NEXTCLOUD_WEBDAV_PATH', 'spmb'),
    ],

];
