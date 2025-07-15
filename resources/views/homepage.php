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
<br>
<section class="restaurant-suggestion">
    <p class="font22">Today you should eat at : <strong><?= $restaurant->name ?></strong></p>
</section>

<section class="description-hp">
    <img class="description-img" src="<?= $restaurant->image ?>">
    <div class="restaurant-description">
        <div>
            <p><strong><?= $restaurant->name ?></strong></p>
            <p><?= $restaurant->description ?></p>
            <div class="info-container">
                <div class="box">
                    <?php if ($restaurant->price_tier < 15) { ?>
                        <p class="span"><img src="/assets/images/price-green.png"</p>
                        <p>Cheap</p>
                    <?php } elseif ($restaurant->price_tier > 15 && $restaurant->price_tier < 30) { ?>
                        <p class="span"><img src="/assets/images/price-yellow.png"></p>
                        <p>Moderate</p>
                    <?php } else { ?>
                        <p class="span"><img src="/assets/images/price-red.png"</p>
                        <p>Expensive</p>
                    <?php }; ?>
                </div>
                <div class="box">
                    <p class="span"><img src="/assets/images/<?= $restaurant->concept ?>.png"></p>
                    <p><?= $restaurant->concept ?></p>
                </div>
                <div class="box">
                    <?php if ($restaurant->veggie_option): ?>
                        <p class="span"><img src="/assets/images/vegan.png"></p>
                        <p>Vegetarian option</p>
                    <?php else: ?>
                        <p class="span"><img src="/assets/images/vegan-red.png"></p>
                        <p>No vegetarian option</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="learn-more-container">
    <label class="modal-btn"><a href="/restaurants/keypoints?restaurant_id=<?= $restaurant->id; ?>">Learn
            More</a></label>
</div>

<section class="discover-more">
    <h2>Do you want more?</h2>
    <label class="modal-btn"><a href="/restaurants/">Discover more</a></label>
</section>


    <section class="section-discover">
    <h3 class="discover-title">Do you want more?</h3>
    <a class="discover-button" href="/restaurants">Discover more</a>
</section>
