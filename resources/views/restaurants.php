<?php

use App\Models\Restaurant;

?>

<h1 class="center">Are you hungry?</h1>
<h2 class="center">Find all our recommended places below and refine them with your criteria</h2>

<div class="filter-container">
    <p class="font22">Filter:</p>
    <div class="select-container">
        <form class="filter-form" method="POST" action="/restaurants/" id="filterForm">
            <div class="custom-select-wrapper">
                <select class="filter" id="price-tier" name="price_tier">
                    <option value="">Price ranges</option>
                    <option value="15" <?= isset($_POST['price_tier']) && $_POST['price_tier'] == '15' ? 'selected' : '' ?>>1 - Budget</option>
                    <option value="30" <?= isset($_POST['price_tier']) && $_POST['price_tier'] == '30' ? 'selected' : '' ?>>2 - Moderate</option>
                    <option value="31" <?= isset($_POST['price_tier']) && $_POST['price_tier'] == '31' ? 'selected' : '' ?>>3 - Expensive</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="concept" id="concept">
                    <option value="">Types</option>
                    <option value="Italian" <?= isset($_POST['concept']) && $_POST['concept'] == 'Italian' ? 'selected' : ''?> >Italian</option>
                    <option value="Vegan" <?= isset($_POST['concept']) && $_POST['concept'] == 'Vegan' ? 'selected' : ''?>>Vegan</option>
                    <option value="Asian" <?= isset($_POST['concept']) && $_POST['concept'] == 'Asian' ? 'selected' : ''?>>Asian</option>
                    <option value="Mexican" <?= isset($_POST['concept']) && $_POST['concept'] == 'Mexican' ? 'selected' : ''?>>Mexican</option>
                    <option value="French" <?= isset($_POST['concept']) && $_POST['concept'] == 'French' ? 'selected' : ''?>>French</option>
                    <option value="Hamburger" <?= isset($_POST['concept']) && $_POST['concept'] == 'Hamburger' ? 'selected' : ''?>>Hamburger</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="diet" id="diet">
                    <option value="">Diet</option>
                    <option value="Vegan" <?= isset($_POST['diet']) && $_POST['diet'] == 'Vegan' ? 'selected' : ''?>>Vegan</option>
                    <option value="Vegetarian" <?= isset($_POST['diet']) && $_POST['diet'] == 'Vegetarian' ? 'selected' : ''?>>Vegetarian</option>
                    <option value="Gluten-Free" <?= isset($_POST['diet']) && $_POST['diet'] == 'Gluten-Free' ? 'selected' : ''?>>Gluten-Free</option>
                    <option value="Flexitarian" <?= isset($_POST['diet']) && $_POST['diet'] == 'Flexitarian' ? 'selected' : ''?>>Flexitarian</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>
            <button class="modal-btn" type="submit">Filter</button>
        </form>
    </div>

</div>

<div class="card-grid" id="restaurantGrid">
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
                            <p class="span"><img src="/assets/images/price-green.png"</p>
                        <?php } elseif ($restaurant->price_tier > 15 && $restaurant->price_tier < 30) { ?>
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
<ul class="pagination-container">
    <li><a href="?page=<?= $pageNumber -1 ?>" class="previous">&laquo; Previous</a></li>
        <?php for ($i = 1; $i <= $nbPages; $i++) {?>
        <li><a href="?page=<?= $i ?>" class="previous"><?php echo  $i ?></a></li>
        <?php } ?>
    <li><a href="?page=<?= $pageNumber +1 ?>" class="next">Next &raquo;</a></li>
</ul>
