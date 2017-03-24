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
        'client_id' => '395537617486721',
        'client_secret' => '92d7e35dff6cc87ce5fe416368dc7148',
        'redirect' => 'http://localhost/TutoLaravel/public/social/callback/facebook',
    ],

    'google' => [
      'client_id' => '247992296075-9kdjcdahe5k8j5h8gc8c74vqbrcosqtd.apps.googleusercontent.com',
      'client_secret' => 'gUNdP_9b3pwh6uNEWUVGFMpx',
      'redirect' => 'http://localhost/TutoLaravel/public/social/callback/google',
     ],

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key' => '',
        'secret' => '',
    ],

];
