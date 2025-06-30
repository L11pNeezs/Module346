<?php

use App\Models\User;

$username = null;
if (isset($_SESSION['id'])) {
    $user = User::getById($_SESSION['id']);
    if ($user) {
        $username = htmlspecialchars($user->username);
    }
}

$restaurant = null;
$image = null;
$price_tier = null;
$concept = null;
$veggie_option = null;

?>
<?php require __DIR__ . '/../templates/header.php'; ?>

<section class="title">
    Today you should eat :
    <div class="restaurant-suggestion">
        <?= $restaurant ?>
    </div>
</section>

<section class="description">
        <img src="<?= $image ?>" alt="food">
    <div class="title-description">
        <?= $restaurant ?>
    </div>

    <div>
        <p class="description-text">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor
            sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.

            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet,
            consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>
    </div>

    <ul class="option-restaurant">
        <li>
            <img src="<?= $image ?>" alt="food">
            <?= $price_tier ?>
        </li>

        <li>
            <img src="<?= $image ?>" alt="food">
            <?= $concept ?>
        </li>

        <li>
            <img src="<?= $image ?>" alt="food">
            <?= $veggie_option ?>
        </li>
    </ul>


</section>
    <section class="section-discover">
    <h3 class="discover-title">Do you want more?</h3>
    <label class="discover-button">Discover more</label>
</section>


<?php require __DIR__ . '/../Templates/footer.php'; ?>

