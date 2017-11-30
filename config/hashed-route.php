<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Transformer configuration
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the hashed route transformers below you wish
    | to use as your default transformer for all your models. You can also
    | set a transformer per model or fetch one manually using the manager.
    |
    */

    'default' => 'hashids',

    /*
    |--------------------------------------------------------------------------
    | Transformer configurations
    |--------------------------------------------------------------------------
    |
    | This is a list of all transformer configurations for all your models.
    | There is an example of options for every driver to make development
    | easy. You can change them however you like.
    |
    */

    'transformers' => [

        'none' => [
            'driver' => 'null',
        ],

        'hashids' => [
            'driver' => 'hashids',
            'salt' => env('HASHIDS_SALT'),
            'minimum_length' => 15,
            'alphabet' => null,
            //'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],
    ],
];