<?php



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
            <div class="auth-buttons">
                <?php if ($username): ?>
                    <span>Welcome, <?= $username ?></span>
                <?php else: ?>
                    <label class="modal-btn" for="modal-toggle">Login</label>
                <?php endif; ?>
            </div>

            <div class="rt-container">
                <div class="col-rt-12">
                    <div>
                        <input id="modal-toggle" type="checkbox">
                        <label class="modal-backdrop" for="modal-toggle"></label>
                        <div class="modal-content">
                            <label class="modal-close-btn" for="modal-toggle"></label>
                            <div class="tabs">
                                <input class="radio" id="tab-1" name="tabs-name" type="radio" checked>
                                <label for="tab-1" class="table"><span>Login</span></label>
                                <div class="tabs-content">
                                    <form action="/login" method="post">
                                        <input name="username" type="text" placeholder="Username" required>
                                        <input name="password" type="password" placeholder="Password" required>
                                        <input class="login-button" type="submit" value="Log In">
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
        </nav>
    </header>
    <main>
