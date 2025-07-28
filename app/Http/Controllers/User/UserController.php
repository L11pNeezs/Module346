<?php

namespace App\Http\Controllers\User;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Libraries\Core\Http\UserValidator\UserValidator;
use App\Models\User;

class UserController extends AbstractController
{
    public function register()
    {

        $validator = new UserValidator;
        $data = request()->all();
        $errors = $validator->validateData($data);

        if (User::find('username', $data['username'])) {
            $errors['username'] = 'Username already exists.';
        }
        if (User::find('email', $data['email'])) {
            $errors['email'] = 'Email already exists.';
        }

        if ($errors) {
            return $this->handleValidationErrors($errors, 'homepage');
        }

        $user = new User;
        $user->username = $data['username'];
        $user->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $user->email = $data['email'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->save();

        if ($user) {
            $_SESSION['id'] = $user->id;
            self::login();
        } else {
            return $this->handleValidationErrors(['general' => 'Registration failed. Please try again.'], 'homepage');
        }

        $this->handleAjaxSuccess();

        header('Location: /');
        exit;
    }

    public function login()
    {
        $data = request()->all();
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required.';
        }

        $user = User::find('username', $data['username']);

        if (! $user) {
            $errors['username'] = 'User not found.';
        } elseif (! password_verify($data['password'], $user->password)) {
            $errors['password'] = 'Incorrect password.';
        }

        if ($errors) {
            return $this->handleValidationErrors($errors, 'homepage');
        }

        $_SESSION['id'] = $user->id;

        $this->handleAjaxSuccess();

        header('Location: /');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['id']);
        header('Location: /');
        exit;
    }
}
