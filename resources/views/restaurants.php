<?php
use App\Models\Restaurant;
require __DIR__ . '/../Templates/header.php';
?>

<div class="restaurants-list-container">
    <ul class="restaurants-list">
        <?php foreach ($restaurants as $restaurant) { ?>
            <li class="restaurants-list-item">
                <?php
                    echo $restaurant->getName();
                ?>
            </li>
        <?php } ?>
    </ul>
</div>

<?php require __DIR__ . '/../Templates/footer.php'; ?>
