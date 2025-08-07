<?php
/** @var \App\Models\Menu_Item|null $menu */

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
        <h2 class="heading-2 text-center">Our Favorite
            : <?= isset($favorite) && ! empty($favorite->name) ? htmlspecialchars($favorite->name) : 'Get a Random' ?>
        </h2>
    </div>
    <div class="flex justify_center">
        <img src="/assets/images/Holy_Cow.jpg" alt="Item" class="">
    </div>
</section>
<div class="div-break-gap-large"></div>
<div>
    <section class="text-center">
        <h2 class="sub_title">Menu</h2>
        <label class="btn"><a href="#" id="toggle-menu-btn">Discover more</a></label>
    </section>
</div>
<div class="div-break-gap-large"></div>
<div class="flex justify_center" id="menu-table-container">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price (CHF)</th>
            <th>Rating</th>
            <th>Vote</th>
            <th>Reviews</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($menu as $index => $item) { ?>
            <tr>
                <td><?= htmlspecialchars($item->name) ?></td>
                <td><?= htmlspecialchars($item->description) ?></td>
                <td><?= htmlspecialchars($item->price) ?></td>
                <td>
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                        <span
                            class="star<?= $i <= (int) round($item->avg_rating ?? 0) ? ' filled' : '' ?>">&#9733;</span>
                    <?php } ?>
                </td>
                <td>
                    <span class="star-rating" data-index="<?= $item->id ?>" data-rating="0">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <span class="star" data-star="<?= $i ?>">&#9733;</span>
                        <?php } ?>
                    </span>
                </td>
                <td>
                    <p><a href="/menu_reviews?menu_item_id=<?= htmlspecialchars($item->id) ?>">Reviews</a></p>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div id="review-modal" class="modal-review" style="display:none;">
        <div class="modal-content-review">
            <span id="close-modal" class="modal-review-close">&times;</span>
            <h3 class="text-center">Leave a Review</h3>
            <div id="error" class="text-center"></div>
            <form id="review-form" class="review-form">
                <input type="hidden" name="menu_id" id="modal-menu-id">
                <input type="hidden" name="rating" id="modal-rating">
                <textarea name="comment" id="modal-comment" placeholder="Write your review..." rows="4"
                          cols="50"></textarea>
                <div>
                    <button class="btn" type="submit">Submit</button>
                    <button class="btn" type="submit">Leave Blank</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="keypoints-map"
     data-restaurants='<?= json_encode($restaurantCoordinates, JSON_HEX_APOS | JSON_HEX_TAG) ?>'>
</div>
<div class="div-break-gap-medium"></div>
<div>
    <h2 class="text-center">Share your Experience</h2>
    <div class="text-center">
        <button id="open-experience-modal" class="btn">Leave a Review</button>
        <a class="btn" href="/restaurant_reviews?restaurant_id=<?= $restaurant->id ?>">Reviews</a>
    </div>
</div>
<div id="experience-modal" class="modal-review" style="display:none;">
    <div class="modal-content-review">
        <span id="close-experience-modal" class="modal-review-close">&times;</span>
        <h3 class="text-center">Share your Experience</h3>
        <div id="error-restaurant" class="text-center"></div>
        <form id="experience-form" class="review-form" method="POST">
            <input type="hidden" name="id" id="modal-experience-id" value="<?= htmlspecialchars($restaurant->id) ?>">
            <input type="hidden" name="rating" id="experience-rating">
            <div class="star-rating-experience" style="font-size:2em; margin-bottom:10px;">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <span class="star-experience" data-star="<?= $i ?>">&#9733;</span>
                <?php } ?>
            </div>
            <textarea name="comment" id="experience-comment" placeholder="Write your review..." rows="4"
                      cols="50"></textarea>
            <div>
                <button class="btn" type="submit">Submit</button>
                <button class="btn" type="button" id="cancel-experience-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
<script src="/assets/js/keypointsMap.js"></script>
<script src="/assets/js/menuToggle.js"></script>
<script src="/assets/js/ratingMenu.js"></script>
<script src="/assets/js/restaurantReview.js"></script>


<style>
    .star-experience {
        cursor: pointer;
        color: #ccc;
    }

    .star-experience.filled {
        color: #f5b301;
    }
</style>
