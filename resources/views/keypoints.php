<?php

use App\Models\Restaurant;

$restaurant = Restaurant::getById($_GET['restaurant_id']);

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
            <?= $restaurant->p_t_description ?>
        </div>
    </div>
    <div class="text-center">
        <h3 class="text-small"><?= $restaurant->concept ?></h3>
        <div>
            <?= $restaurant->c_description ?>

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
