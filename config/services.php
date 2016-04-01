<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'facebook' => [
        'client_id' => '1687397541510679',
        'client_secret' => '828d92d136471b2d55d13972aa454ec5',
        'redirect' => 'http://localhost/Game/public/social/callback/facebook',
    ],

    'google' => [
        'client_id' => '832562261312-fja0rcspmlulpeiartrlblastqb091dv.apps.googleusercontent.com',
        'client_secret' => 'rRkEVk14mZ9EdTM9bt4hlvPm',
        'redirect' => 'http://localhost/Game/public/social/callback/google',
    ],


    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
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

];
