<?php
/** @var int $pageNumber */
use App\Models\Restaurant;

$concepts = Restaurant::getConcepts();
$diets = Restaurant::getDiets();
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
                    <?php foreach (PRICE_TIERS as $value => $label) { ?>
                        <option value="<?= htmlspecialchars($value) ?>" <?= isset($_GET['price_tier']) && $_GET['price_tier'] == $value ? 'selected' : '' ?>>
                            <?= htmlspecialchars($label) ?>
                        </option>
                    <?php } ?>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="concept" id="concept">
                    <option value="">Types</option>
                    <?php foreach ($concepts as $concept) { ?>
                        <option value="<?= htmlspecialchars($concept) ?>" <?= isset($_GET['concept']) && $_GET['concept'] == $concept ? 'selected' : '' ?>>
                            <?= htmlspecialchars($concept) ?>
                        </option>
                    <?php } ?>
                </select>
                <svg class="custom-arrow" viewBox="0 0 10 6">
                    <path d="M0 0 L5 6 L10 0" fill="black"/>
                </svg>
            </div>

            <div class="custom-select-wrapper">
                <select class="filter" name="diet" id="diet">
                    <option value="">Diet</option>
                    <?php foreach ($diets as $diet) { ?>
                    <option value="<?= htmlspecialchars($diet) ?>" <?= isset($_GET['diet']) && $_GET['diet'] == $diet ? 'selected' : '' ?>>
                        <?= htmlspecialchars($diet) ?>
                    </option>
                    <?php } ?>
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
    <?php include __DIR__.'/partials/restaurant_cards.php' ?>
</div>
