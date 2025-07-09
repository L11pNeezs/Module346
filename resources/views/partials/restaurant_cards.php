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
                    <?php if ($restaurant->price_tier <= 15) { ?>
                        <p class="span"><img src="/assets/images/price-green.png"></p>
                    <?php } elseif ($restaurant->price_tier > 15 && $restaurant->price_tier < 30) { ?>
                        <p class="span"><img src="/assets/images/price-yellow.png"></p>
                    <?php } else { ?>
                        <p class="span"><img src="/assets/images/price-red.png"></p>
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
