<?php

use App\Models\User;

$username = null;
if (isset($_SESSION['id'])) {
    $user = User::getById($_SESSION['id']);
    if ($user) {
        $username = htmlspecialchars($user->username);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Header</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>

    <header>
        <script src="/assets/js/hamburgerMenu.js"></script>
        <div class="title-container">
            <img class="logo" src="/assets/images/koa-la-logo.png" alt="logo">
            <h1><a class="title" href="#">Koa-La</a></h1>
        </div>
        <nav class="nav-bar">

            <ul class="nav-bar-link ">
                <li>
                        Map
                </li>
                <li>
                        Places
                </li>
                <li>
                        Contribute
                </li>
            </ul>

            <button class="log-button login-button">Login</button>
            </nav>
    </header>
    <main>
