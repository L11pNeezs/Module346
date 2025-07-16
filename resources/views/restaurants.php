<?php

?>

<h1 class="text-subtitle text-center">Are you hungry?</h1>
<h2 class="text-small text-center">Find all our recommended places below and refine them with your criteria</h2>

<div class="flex_col align_center justify_center">
    <p class="padding_margin_zero">Filter:</p>
    <div class="flex gap-small">
        <form class="flex_col align_center gap-small margin-medium" method="GET" action="/restaurants" id="filterForm">
            <div class="custom-select-wrapper">
                <select class="filter" id="price-tier" name="price_tier">
                    <option value="">Price ranges</option>
                    <option value="15" <?= isset($_GET['price_tier']) && $_GET['price_tier'] == '15' ? 'selected' : '' ?>>1 - Budget</option>
                    <option value="30" <?= isset($_GET['price_tier']) && $_GET['price_tier'] == '30' ? 'selected' : '' ?>>2 - Moderate</option>
                    <option value="31" <?= isset($_GET['price_tier']) && $_GET['price_tier'] == '31' ? 'selected' : '' ?>>3 - Expensive</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="concept" id="concept">
                    <option value="">Types</option>
                    <option value="Italian" <?= isset($_GET['concept']) && $_GET['concept'] == 'Italian' ? 'selected' : ''?> >Italian</option>
                    <option value="Vegan" <?= isset($_GET['concept']) && $_GET['concept'] == 'Vegan' ? 'selected' : ''?>>Vegan</option>
                    <option value="Asian" <?= isset($_GET['concept']) && $_GET['concept'] == 'Asian' ? 'selected' : ''?>>Asian</option>
                    <option value="Mexican" <?= isset($_GET['concept']) && $_GET['concept'] == 'Mexican' ? 'selected' : ''?>>Mexican</option>
                    <option value="French" <?= isset($_GET['concept']) && $_GET['concept'] == 'French' ? 'selected' : ''?>>French</option>
                    <option value="Hamburger" <?= isset($_GET['concept']) && $_GET['concept'] == 'Hamburger' ? 'selected' : ''?>>Hamburger</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="diet" id="diet">
                    <option value="">Diet</option>
                    <option value="Vegan" <?= isset($_GET['diet']) && $_GET['diet'] == 'Vegan' ? 'selected' : ''?>>Vegan</option>
                    <option value="Vegetarian" <?= isset($_GET['diet']) && $_GET['diet'] == 'Vegetarian' ? 'selected' : ''?>>Vegetarian</option>
                    <option value="Gluten-Free" <?= isset($_GET['diet']) && $_GET['diet'] == 'Gluten-Free' ? 'selected' : ''?>>Gluten-Free</option>
                    <option value="Flexitarian" <?= isset($_GET['diet']) && $_GET['diet'] == 'Flexitarian' ? 'selected' : ''?>>Flexitarian</option>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>
            <input type="hidden" name="page" value="<?= $pageNumber ?>">
            <button class="btn" type="submit">Filter</button>
        </form>
    </div>

</div>

<div class="card-grid" id="restaurantGrid">
    <?= include __DIR__ . '/partials/restaurant_cards.php' ?>
</div>
