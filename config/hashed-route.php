<?php

return [

    'default' => 'hashids',

    'transformers' => [
        'hashids' => [
            'driver' => 'hashids',
            'salt' => env('HASHIDS_SALT'),
            'minimum_length' => 15,
            'alphabet' => null,
            //'alphabet' => 'abcdefghijklmnopqrstuvwxyz1234567890'
        ],
        'none' => [
            'driver' => 'null',
        ]
    ]
];