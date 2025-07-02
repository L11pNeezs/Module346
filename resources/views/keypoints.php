<?php
Use App\Models\Restaurant;

$restaurant = Restaurant::getById($_GET['restaurant_id']);

?>

<h1 class="title"><?= $restaurant->name ?></h1>

<section class="title-container">
    <img src="/assets/images/<?= $restaurant->image ?>" style="width: 1000px; height: 350px;">
</section>

<h1 class="title">Keypoints</h1>
<section class="keypoints-container">
    <div class="keypoints-div">
        <h2><?= $restaurant->price_tier ?></h2>
        <section class="keypoints-div-description">
            <?= $restaurant->p_t_description ?>

        </section>
    </div>
    <div class="keypoints-div">
        <h2><?= $restaurant->concept ?></h2>
        <section class="keypoints-div-description">
            <?= $restaurant->c_description ?>

        </section>
    </div>
    <div class="keypoints-div">
        <h2><?= $restaurant->veggie_options ?></h2>
        <section class="keypoints-div-description">
            <?= $restaurant->v_o_description ?>

        </section>
    </div>
</section>
