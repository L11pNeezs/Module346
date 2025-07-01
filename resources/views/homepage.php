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

<section class="title">
    Today you should eat :
    <div class="restaurant-suggestion">
        <?= $restaurant->name ?>
    </div>
</section>

<section class="description">
        <img src="/assets/images/<?= $restaurant->image ?>" style="width: 400px; height: 350px;">
    <div class="title-description">
        <?= $restaurant->description ?>
    </div>
    <div class="learn-more-container">
        <a class="learn-more-anchor" href="">Learn More</a>
    </div>
</section>

<section class="restaurant-options">
    <ul class="restaurant-list">
        <li>
            <?= $restaurant->price_tier ?>
        </li>

        <li
            <?= $restaurant->concept ?>
        </li>

        <li>
            <?= $restaurant->veggie_options?>
        </li>
    </ul>
</section>


    <section class="section-discover">
    <h3 class="discover-title">Do you want more?</h3>
    <a class="discover-button" href="/restaurants/">Discover more</a>
</section>
