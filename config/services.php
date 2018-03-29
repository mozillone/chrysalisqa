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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'sendgrid' => [
        'api_key' => "MS5-a15cRGeeSZCaB82vYw"
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
    'chyrsalis_mail_add' => [
        'test_email' => env('TEST_EMAIL'),
        'admin_email' => env('ADMIN_EMAIL'),
        'job_email' => env('JOB_EMAIL'),
        'info_email' => env('INFO_EMAIL'),
        'support_email' => env('SUPPORT_EMAIL')
    ],
   'facebook' => [
            'client_id' =>  env('FACEBOOK_CLIENT_ID'),
            'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
            'redirect' => env('FACEBOOK_REDIRECT'),
    ],
    
    'google' => [
            'client_id' =>  env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect' => env('GOOGLE_REDIRECT'),
    ],
    'usps' => [
        'username' => "402SAMPL6330"
    ],
    'braintree' => [
        'environment' => 'sandbox',
        'merchantId' => 'zvht7pmsv354kbmr',
        'publicKey' => 'fbxq6zj582n6pf32',
        'privateKey' => 'e030696d137f744e22df247ba67d6fb2',
        'clientSideEncryptionKey' => 'MIIBCgKCAQEAor2CgZhT5+SaubGnRkUJIcx/77FYFoMHgwSwty/5vpRdGYFeSH1S/GA04S0V84EujtiY5mi1XdM1GKi9BJNLd9MLHAlOtLann+T235y9tyEbJkL9gDWiL75umS+Ft8LTo0lBjTZuffnQeFTLf4ZmyskfoRdgJaeQdbVntnLXRAJEaHA8MFtVXYVFvGDTeTxBKwBP6l2S3+PpRmAXzJl+WbrdMCq1qr6we9FElqSu8lsfoTHZywoa7jLLLvCLn4n5A7PdVjaz4Uh2eP/PIzUvPq6ObSMcxCE1hEsgRAUhzWBsL8sDTVxiXZsxyC4P8/TVPdrNBHXdm6a28eMcTmbbhwIDAQAB',
    ]


];
