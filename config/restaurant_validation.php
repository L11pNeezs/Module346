<?php

return [
    'name' => [
        'required' => true,
        'min_length' => 2,
        'max_length' => 100,
        'messages' => [
            'required' => 'Place name is required.',
            'min_length' => 'Place name must be at least 2 characters.',
            'max_length' => 'Place name must not exceed 100 characters.',
        ],
    ],
    'address' => [
        'required' => true,
        'min_length' => 5,
        'max_length' => 255,
        'messages' => [
            'required' => 'Location is required.',
            'min_length' => 'Location must be at least 5 characters.',
            'max_length' => 'Location must not exceed 255 characters.',
        ],
    ],
    'description' => [
        'required' => true,
        'min_length' => 10,
        'max_length' => 500,
        'messages' => [
            'required' => 'Description is required.',
            'min_length' => 'Description must be at least 10 characters.',
            'max_length' => 'Description must not exceed 500 characters.',
        ],
    ],
    'image' => [
        'required' => false,
        'valid_url' => 'Image URL must be a valid URL.',
        'valid_image' => 'Image URL must point to a valid image file (jpg, jpeg, png, gif).',
        'pattern' => '/\.(jpg|jpeg|png|gif)$/i',
        'messages' => [
            'required' => 'Image URL is required.',
            'valid_url' => 'Image URL must be a valid URL.',
            'valid_image' => 'Image URL must point to a valid image file (jpg, jpeg, png, gif).',
        ],
    ],
    'price_tier' => [
        'required' => true,
        'messages' => [
            'required' => 'Price tier is required.',
        ],
    ],
    'concept' => [
        'required' => true,
        'messages' => [
            'required' => 'Concept is required.',
        ],
    ],
    'diet' => [
        'required' => true,
        'messages' => [
            'required' => 'Diet is required.',
        ],
    ],
];
