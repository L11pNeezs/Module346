<?php

use App\Models\Restaurant;

?>

<h1 class="center">Are you hungry?</h1>
<h2 class="center">Find all our recommended places below and refine them with your criteria</h2>

<div class="filter-container">
    <p class="font22">Filter:</p>
    <div class="select-container">

        <div class="custom-select-wrapper">
            <select class="filter" id="price-tier" name="price_tier">
                <option value="">Price ranges</option>
                <option value="$">1 - Budget</option>
                <option value="$$">2 - Moderate</option>
                <option value="$$$">3 - Expensive</option>
            </select>
            <svg class="custom-arrow" viewBox="0 0 10 6">
                <path d="M0 0 L5 6 L10 0" fill="black"/>
            </svg>
        </div>

        <div class="custom-select-wrapper">
            <select class="filter" name="concept" id="concept">
                <option value="">Types</option>
                <option value="Italian">Italian</option>
                <option value="Vegan">Vegan</option>
                <option value="Asian">Asian</option>
                <option value="Mexican">Mexican</option>
                <option value="French">French</option>
            </select>
            <svg class="custom-arrow" viewBox="0 0 10 6">
                <path d="M0 0 L5 6 L10 0" fill="black"/>
            </svg>
        </div>

        <div class="custom-select-wrapper">
            <select class="filter" name="diet">
                <option value="">Diet</option>
                <option value="Vegan">Vegan</option>
                <option value="Vegetarian">Vegetarian</option>
                <option value="Gluten-Free">Gluten-Free</option>
                <option value="Flexitarian">Flexitarian</option>
            </select>
            <svg class="custom-arrow" viewBox="0 0 10 6">
                <path d="M0 0 L5 6 L10 0" fill="black"/>
            </svg>
        </div>

    </div>
</div>
<div class="card-grid">
    <?php foreach ($restaurants as $restaurant): ?>
        <div class="card">
            <div class="img">
                <a href="/restaurants/keypoints?restaurant_id=<?= $restaurant->id ?>">
                    <img src="<?= $restaurant->image ?>" alt="<?= htmlspecialchars($restaurant->name) ?>">
                </a>
            </div>
            <div class="text">
                <p class="h3"> <?= $restaurant->name ?> </p>
                <p><?= $restaurant->description ?></p>
                <br>
                <div class="icon-container">
                    <div class="icon-box">
                        <?php if($restaurant->price_tier < 15) {?>
                        <p class="span"><img src="/assets/images/price-green.png"</p>
                        <?php } elseif($restaurant->price_tier > 15 && $restaurant->price_tier < 30) { ?>
                        <p class="span"><img src="/assets/images/price-yellow.png"></p>
                        <?php } else { ?>
                        <p class="span"><img src="/assets/images/price-red.png"</p>
                        <?php }; ?>
                    </div>
                    <div class="icon-box">
                        <p class="span"><img src="/assets/images/<?= $restaurant->concept ?>.png"></p>
                    </div>
                    <div class="icon-box">
                        <?php if ($restaurant->veggie_option): ?>
                        <p class="span"><img src="/assets/images/vegan.png"></p>
                        <?php else: ?>
                        <p class="span"><img src="/assets/images/vegan-red.png"></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
