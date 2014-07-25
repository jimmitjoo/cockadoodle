<?php

return [

/*
|--------------------------------------------------------------------------
| oAuth Config
|--------------------------------------------------------------------------
*/

/**
* Storage
*/
'storage' => 'Session',

/**
* Consumers
*/
'consumers' => [

    /**
    * Facebook
    */
    'Facebook' => [
        'client_id'     => '914790165202910',
        'client_secret' => 'a73bee0e072983dfde8c1a985c97fe08',
        'scope'         => ['email','user_online_presence'],
    ],

]

];