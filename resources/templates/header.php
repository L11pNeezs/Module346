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

<header>
    <div class="title-container">
        <img class="logo" src="/assets/images/koa-la-logo.png" alt="logo">
        <h1><a href="/">Koa-La</a></h1>
    </div>
    <nav class="nav-bar">
        <button class="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="nav-bar-link">
            <li>
                <button class="close-menu" aria-label="Close menu">&times;</button>
            </li>
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
                                    <?php foreach (USERLOGIN_FORM_FIELDS as $field): ?>
                                    <input
                                        type="<?= htmlspecialchars($field['type']) ?>"
                                        name="<?= htmlspecialchars($field['name']) ?>"
                                        placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                                        class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>">
                                    <?php if (!empty($errors[$field['name']])): ?>
                                        <span class="error"><?= htmlspecialchars($errors[$field['name']]) ?></span>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <input class="login-button" type="submit" value="Log In">
                                </form>
                            </div>
                            <input class="radio" id="tab-2" name="tabs-name" type="radio">
                            <label for="tab-2" class="table"><span>Sign up</span></label>
                            <div class="tabs-content">
                                <form action="/signup" method="post">
                                    <?php foreach (USERSIGNUP_FORM_FIELDS as $field): ?>
                                    <input
                                        type="<?= htmlspecialchars($field['type']) ?>"
                                        name="<?= htmlspecialchars($field['name']) ?>"
                                        placeholder="<?= htmlspecialchars($field['placeholder']) ?>"
                                        class="<?php if (!empty($errors[$field['name']])): ?>error<?php endif; ?>"
                                    >
                                        <?php if (!empty($errors[$field['name']])): ?>
                                            <span class="error"><?= htmlspecialchars($errors[$field['name']]) ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <input class="login-button" type="submit" value="Sign Up">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth-buttons">
            <?php if ($username): ?>
                <span class="user-log">Welcome, <?= $username ?></span>
                <a href="/logout" class="modal-btn">Log-Out</a>
            <?php else: ?>
                <label class="modal-btn" for="modal-toggle">Login</label>
            <?php endif; ?>
        </div>

    </nav>
</header>
<main>
