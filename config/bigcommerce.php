<?php

return[


    /*
    |--------------------------------------------------------------------------
    | Bigcommerce Api
    |--------------------------------------------------------------------------
    |
    | This file is for setting the credentials for bigcommerce api key and secret.
    |
    */
    'default' => env("BC_CONNECTION", 'oAuth'),

    'bc_local_client_id' => env('BC_LOCAL_CLIENT_ID'),

    'bc_app_client_id' => env('BC_APP_CLIENT_ID'),

    'bc_local_secret' => env('BC_LOCAL_SECRET'),
    
    'bc_app_secret' => env('BC_APP_SECRET'),
    
    'bc_local_access_token' => env('BC_LOCAL_ACCESS_TOKEN'),

    'bc_local_store_hash' => env('BC_LOCAL_STORE_HASH'),

    'basicAuth' => [
        'store_url' => env("BC_STORE_URL", null),
        'username'  => env("BC_USERNAME", null),
        'api_key'   => env("BC_API_KEY", null)
    ],

    'oAuth' => [
        'client_id'     => env("BC_CLIENT_ID", null),
        'client_secret' => env("BC_CLIENT_SECRET", null),
        'redirect_url'  => env("BC_REDIRECT_URL", null)
    ],

    'store' => [
        'store_hash' => env('BC_STORE_HASH', null),
        'store_token' => env('BC_STORE_TOKEN', null),
    ]

];