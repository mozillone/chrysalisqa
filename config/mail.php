<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => env('MAIL_HOST', env('MAIL_HOST')),

    'port' => env('MAIL_PORT', 587),

    'from' => ['address' => 'vamsi@dotcomweavers.com', 'name' => 'vamsi'],

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,
];
