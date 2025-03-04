<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

'mailgun' => [
        'domain' => env('sandbox0d81fea5a92944208509bbbb03db6f8f.mailgun.org'),
        'secret' => env('key-b9c7208aad20ea3f019d2536db619fc5'),//'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJ0b2tlbiI6IjRlZjU3YjY2NTU2ZTcwOThmNjRkZWI3OTIzMDc0OTYxIn0.bCzBTW_JWQ89cGs7F1gyz0Nc8BdZY0PnjRTF-PGlqSDFHYTxwNOZ7E-TBbpX41_Nb2lOzUAC02E8AyN0TeBT0w'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'nexmo' => [
        'key' => env('NEXMO_KEY'),
        'secret' => env('NEXMO_SECRET'),
        'sms_from' => '15556666666',
    ],

];
