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

    <title>Koa-la</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/ol.css">
    <link rel="stylesheet" href="/assets/css/main.css">

</head>

<script src="/assets/js/hamburgerMenu.js"></script>
<body>

<header class="flex">
    <div class="flex_row align_center">
        <img src="/assets/images/koa-la-logo.png" alt="logo">
        <h1 class="title"><a href="/">Koa-La</a></h1>
    </div>
    <nav class="flex align_center gap-small">
        <button class="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="nav-bar-link gap-small">
            <li><a href="/map">Map</a></li>
            <li><a href="/restaurants">Places</a></li>
            <li><a href="/restaurants/contribute">Contribute</a></li>
        </ul>
        <div class="rt-container">
            <div class="col-rt-12">
                <div>
                    <input id="modal-toggle" type="checkbox">
                    <label class="modal-backdrop" for="modal-toggle"></label>
                    <div class="modal-content">
                        <label class="modal-close-btn" for="modal-toggle">✕</label>
                        <label class="modal-close-btn" for="modal-toggle"></label>
                        <div class="tabs">
                            <input class="radio" id="tab-1" name="tabs-name" type="radio" checked>
                            <label for="tab-1" class="table"><span>Login</span></label>
                            <div class="tabs-content">
                                <form action="/login" method="post">
                                    <input name="username" type="text" placeholder="Username" required>
                                    <input name="password" type="password" placeholder="Password" required>
                                    <input class="login-button" type="submit" value="Login">
                                </form>
                            </div>
                            <input class="radio" id="tab-2" name="tabs-name" type="radio">
                            <label for="tab-2" class="table"><span>Sign up</span></label>
                            <div class="tabs-content">
                                <form action="/signup" method="post">
                                    <input name="username" placeholder="Username">
                                    <input name="name" type="text" placeholder="First Name" required>
                                    <input name="surname" type="text" placeholder="Last Name" required>
                                    <input name="email" type="email" placeholder="Email" required>
                                    <input name="password" type="password" placeholder="Password" required>
                                    <input class="login-button" type="submit" value="Sign Up">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <?php if ($username) { ?>
                <span>Welcome, <?= $username ?></span>
                <label class="btn"><a href="/logout">Logout</a></label>
            <?php } else { ?>
                <label class="btn" for="modal-toggle">Login</label>
            <?php } ?>
        </div>
    </nav>
</header>
<main>
