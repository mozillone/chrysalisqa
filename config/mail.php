<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),

    'host' => env('MAIL_HOST', env('MAIL_HOST')),

    'port' => env('MAIL_PORT', 587),

<<<<<<< HEAD
    'from' => ['address' => 'web@dotcomweavers.net', 'name' => 'Chrysalis'],
=======
    'from' => ['address' => 'vamsi@dotcomweavers.com', 'name' => 'vamsi'],
>>>>>>> 7cf720f54d5179fec7049e4569c6e1bc2a5e80b3

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,
];
