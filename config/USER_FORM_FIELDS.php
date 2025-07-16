<?php
const USERSIGNUP_FORM_FIELDS = [
    'username' => [
        'element' => 'input',
        'name' => 'username',
        'type' => 'text',
        'required' => true,
        'min_length' => 3,
        'max_length' => 100,
        'placeholder' => 'Enter Your Username',
    ],
    'name' => [
        'element' => 'input',
        'name' => 'name',
        'type' => 'text',
        'placeholder' => 'Enter Your First Name',
    ],
    'surname' => [
        'element' => 'input',
        'name' => 'surname',
        'type' => 'text',
        'placeholder' => 'Enter Your Last Name'
    ],
    'email' => [
        'element' => 'input',
        'name' => 'email',
        'type' => 'email',
        'placeholder' => 'Enter Your Email'
    ],
    'password' => [
        'element' => 'input',
        'name' => 'password',
        'type' => 'password',
        'placeholder' => 'Enter Your Password',
    ]
];

const USERLOGIN_FORM_FIELDS = [
    'username' => [
        'element' => 'input',
        'name' => 'username',
        'type' => 'text',
        'required' => true,
        'min_length' => 3,
        'max_length' => 100,
        'placeholder' => 'Enter Your Username',
    ],
    'password' => [
        'element' => 'input',
        'name' => 'password',
        'type' => 'password',
        'required' => true,
        'placeholder' => 'Enter Your Password',
    ]
];
