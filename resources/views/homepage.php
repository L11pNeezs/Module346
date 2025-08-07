<?php

/** @var \App\Models\Restaurant|null $restaurant */
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
<section>
    <p class="text-center sub_title">Today you should eat at : <strong><?= $restaurant->name ?></strong></p>
</section>

<section class="img-container flex_col align_center">
    <div class="flex justify_center with-100">
        <img src="<?= $restaurant->image ?>">
    </div>

        <div class="with-100">
            <p class="text-center"><strong><?= $restaurant->name ?></strong></p>
            <p class="text-center margin-large"><?= $restaurant->description ?></p>
            <div class="icon-box-hp flex space-around padding-small">
                <div class="text-center flex gap-small justify_center align_center">
                    <?php if ($restaurant->price_tier === '$') { ?>
                        <p><img src="/assets/images/price-tiers/<?= $restaurant->price_tier ?>.png"</p>
                        <p>Budget</p>
                    <?php } elseif ($restaurant->price_tier === '$$') { ?>
                        <p><img src="/assets/images/price-tiers/<?= $restaurant->price_tier ?>.png"></p>
                        <p>Moderate</p>
                    <?php } else { ?>
                        <p><img src="/assets/images/price-tiers/<?= $restaurant->price_tier ?>.png"</p>
                        <p>Expensive</p>
                    <?php } ?>
                </div>
                <div class="text-center flex gap-small justify_center align_center">
                    <p><img src="/assets/images/food-icons/<?= $restaurant->concept ?>.svg"></p>
                    <p><?= $restaurant->concept ?></p>
                </div>
                <div class="text-center flex gap-small justify_center align_center">
                    <?php if ($restaurant->veggie_option) { ?>
                        <p><img src="/assets/images/vegan.png"></p>
                        <p>Vegetarian option</p>
                    <?php } else { ?>
                        <p><img src="/assets/images/vegan-red.png"></p>
                        <p>No vegetarian option</p>
                    <?php } ?>
                </div>
            </div>
        <div class="div-break-gap-large"></div>
        <div class="text-center">
            <label class="btn"><a href="/restaurants/keypoints?restaurant_id=<?= $restaurant->id; ?>">Learn More</a></label>
        </div>
    </div>
</section>
<br>

<br>
<div class="div-break-gap-large"></div>
<section class="text-center">
    <h2 class="sub_title">Do you want more?</h2>
    <label class="btn"><a href="/restaurants">Discover more</a></label>
</section>
<div class="div-break-gap-large"></div>
