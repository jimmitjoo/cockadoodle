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
        'client_id'     => '920152358000024',
        'client_secret' => 'cce7b5f67c2c7b544c02603fcaa3fdcf',
        'scope'         => ['email','read_friendlists','user_online_presence'],
    ],

]

];