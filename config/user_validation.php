<?php

return [
    'name' => [
        'required' => true,
        'min_length' => 2,
        'max_length' => 20,
        'messages' => [
            'required' => 'Name is required.',
            'min_length' => 'Name must be at least 2 characters.',
            'max_length' => 'Name must not exceed 20 characters.',
        ],
    ],
    'password' => [
        'required' => true,
        'min_length' => 6,
        'max_length' => 20,
        'messages' => [
            'required' => 'Password is required.',
            'min_length' => 'Password must be at least 6 characters.',
            'max_length' => 'Password must not exceed 20 characters.',
        ],
    ],
    'email' => [
        'required' => true,
        'valid_email' => true,
        'messages' => [
            'required' => 'Email is required.',
            'valid_email' => 'Email must be a valid email address.',
        ],
    ],
    'username' => [
        'required' => true,
        'min_length' => 3,
        'max_length' => 20,
        'messages' => [
            'required' => 'Username is required.',
            'min_length' => 'Username must be at least 3 characters.',
            'max_length' => 'Username must not exceed 20 characters.',
        ],
    ],
    'surname' => [
        'required' => true,
        'min_length' => 2,
        'max_length' => 20,
        'messages' => [
            'required' => 'Surname is required.',
            'min_length' => 'Surname must be at least 2 characters.',
            'max_length' => 'Surname must not exceed 20 characters.',
        ],
    ],
];
