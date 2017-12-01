<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Codec configuration
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the hashed route codecs below you wish
    | to use as your default codec for all your models. You can also
    | set a codec per model or fetch one manually using the manager.
    |
    */

    'default' => 'hashids',

    /*
    |--------------------------------------------------------------------------
    | Codec configurations
    |--------------------------------------------------------------------------
    |
    | This is a list of all codec configurations for all your models.
    | There is an example of options for every driver to make development
    | easy. You can change them however you like.
    |
    | Supported drivers are: 'null', 'hashids', 'base64'.
    |
    */

    'codecs' => [

        'none' => [
            'driver' => 'null',
        ],

        'hashids' => [
            'driver' => 'hashids',
            'salt' => env('HASHED_ROUTE_SALT'),
            'minimum_length' => 15,
            'alphabet' => null,
            //'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],

        'base64' => [
            'driver' => 'base64',
            'salt' => env('HASHED_ROUTE_SALT')
        ]
    ],
];