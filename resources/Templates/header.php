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

<header>
    <div class="title-container">
        <img class="logo" src="../img/Pasted%20image.png" alt="logo">
        <h1><a class="title" href="404.php">TTE</a></h1>
    </div>
    <nav class="nav-bar">
        <ul class="nav-bar-link">
            <li><a href="map.html">Map</a></li>
            <li><a href="places.html">Places</a></li>
            <li><a href="contribute">Contribute</a></li>
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
                                <form action="/logintest" method="POST">
                                    <input type="text" name="username" placeholder="Username" required>
                                    <input type="password" name="password" placeholder="Password" required>
                                    <input type="submit" value="Log In">
                                </form>
                            </div>
                            <input class="radio" id="tab-2" name="tabs-name" type="radio">
                            <label for="tab-2" class="table"><span>Sign up</span></label>
                            <div class="tabs-content">
                                <form action="/signup" method="POST">
                                    <input type="text" name="username" placeholder="Username" required>
                                    <input type="text" name="name" placeholder="First Name" required>
                                    <input type="text" name="surname" placeholder="Last Name" required>
                                    <input type="email" name="email" placeholder="Email" required>
                                    <input type="password" name="password" placeholder="Password" required>
                                    <input type="submit" value="Sign Up">
                                </form>
                            </div>
                        </div>
                    </div>
    </nav>
</header>
