<?php

use App\Models\Restaurant;

$data = request()->all();
$restaurant = Restaurant::getById($data['restaurant_id']);

?>

<h1 class="text-title text-center"><?= $restaurant->name ?></h1>

<section class="flex justify_center img-container">
    <img src="<?= $restaurant->image ?>">
</section>

<h1 class="text-subtitle padding-left">Keypoints</h1>
<div class="div-break-gap-large"></div>
<section class="keypoints">
    <div class="">
        <?php if ($restaurant->price_tier === '$') { ?>
            <h3 class="text-small">Budget</h3>
        <?php } elseif ($restaurant->price_tier === '$$') { ?>
            <h3 class="text-small">Moderate</h3>
        <?php } else { ?>
            <h3 class="text-small">Expensive</h3>
        <?php } ?>
        <div>
            <p><?= $restaurant->price_tier_description ?></p>
        </div>
        <div>
            <img src="/assets/images/price-tiers/<?= $restaurant->price_tier ?>.png" alt="Veggie Option"
                 class="option-icons">
        </div>
    </div>
    <div class="">
        <h3 class="text-small"><?= $restaurant->concept ?></h3>
        <div>
            <p><?= $restaurant->concept_description ?></p>
        </div>
        <div>
            <img src="/assets/images/food-icons/<?= $restaurant->concept ?>.svg" alt="Veggie Option"
                 class="option-icons">
        </div>
    </div>
    <div class="">
        <h3 class="text-small">Veggie Option</h3>
        <div>
            <p><?= $restaurant->vegan_option_description ?></p>
        </div>
        <div>
            <?php if ($restaurant->vegan_option === true) { ?>
                <img src="/assets/images/vegan.png" alt="Veggie Option" class="option-icons">
            <?php } else { ?>
                <img src="/assets/images/vegan-red.png" alt="Veggie Option" class="option-icons">
            <?php } ?>
        </div>
    </div>
</section>
<div class="div-break-gap-large"></div>
<section class="space-around align_center flex_row gap-medium favorite"> <!-- Favorite -->
    <div>
        <h2 class="heading-2 text-center">Our Favorite : [$menuitem->name]</h2>
    </div>
    <div class="flex justify_center">
        <img src="/assets/images/Holy_Cow.jpg" alt="Item" class="">
    </div>
</section>
<div class="div-break-gap-large"></div>
<div>
    <section class="text-center">
        <h2 class="sub_title">Menu</h2>
        <label class="btn"><a href="#">Discover more</a></label>
    </section>
</div>
<div class="div-break-gap-large"></div>

<div id="keypoints-map"
     data-restaurants='<?= json_encode($restaurantCoordinates, JSON_HEX_APOS | JSON_HEX_TAG) ?>'></div>
<script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
<script src="/assets/js/keypointsMap.js"></script>
