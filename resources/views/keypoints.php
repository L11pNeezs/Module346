<?php

use App\Libraries\Core\Facades\DB;
Use App\Models\Restaurant;

$data = request()->all();
$restaurant = Restaurant::getById($data['restaurant_id']);

?>

<h1 class="text-title text-center"><?= $restaurant->name ?></h1>

<section class="flex justify_center img-container">
    <img src="<?= $restaurant->image ?>">
</section>

<h1 class="text-subtitle text-center">Keypoints</h1>

<section class="keypoints">
    <div class="text-center">
        <h3 class="text-small"><?= $restaurant->price_tier ?></h3>
        <div>
            <?= $restaurant->price_tier_description ?>
        </div>
    </div>
    <div class="text-center">
        <h3 class="text-small"><?= $restaurant->concept ?></h3>
        <div>
            <?= $restaurant->concept_description ?>

        </div>
    </div>
    <div class="text-center">
        <h3 class="text-small">Veggie Option</h3>
        <div>
            <p>YOLO</p>
            <?= $restaurant->v_o_description ?>

        </div>
    </div>
</section>

<div id="keypoints-map" data-restaurants='<?= json_encode($restaurantCoordinates, JSON_HEX_APOS | JSON_HEX_TAG) ?>'></div>
<script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
<script src="/assets/js/keypointsMap.js"></script>
