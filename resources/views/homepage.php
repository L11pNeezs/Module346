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
    <img src="<?= $restaurant->image ?>">
    <div>
        <div>
            <p class="text-center"><strong><?= $restaurant->name ?></strong></p>
            <p class="text-center"><?= $restaurant->description ?></p>
            <div class="icon-box-hp flex space-around padding-small">
                <div class="text-center">
                    <?php if ($restaurant->price_tier < 15) { ?>
                        <p><img src="/assets/images/price-green.png"</p>
                        <p>Cheap</p>
                    <?php } elseif ($restaurant->price_tier > 15 && $restaurant->price_tier <= 30) { ?>
                        <p><img src="/assets/images/price-yellow.png"></p>
                        <p>Moderate</p>
                    <?php } else { ?>
                        <p><img src="/assets/images/price-red.png"</p>
                        <p>Expensive</p>
                    <?php } ?>
                </div>
                <div class="text-center">
                    <p><img src="/assets/images/<?= $restaurant->concept ?>.png"></p>
                    <p><?= $restaurant->concept ?></p>
                </div>
                <div class="text-center">
                    <?php if ($restaurant->veggie_option) { ?>
                        <p><img src="/assets/images/vegan.png"></p>
                        <p>Vegetarian option</p>
                    <?php } else { ?>
                        <p><img src="/assets/images/vegan-red.png"></p>
                        <p>No vegetarian option</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<div class="text-center">
    <label class="btn"><a href="/restaurants/keypoints?restaurant_id=<?= $restaurant->id; ?>">Learn More</a></label>
</div>
<br>
<section class="text-center">
    <h2 class="sub_title">Do you want more?</h2>
    <label class="btn"><a href="/restaurants">Discover more</a></label>
</section>
<br>
<br>
