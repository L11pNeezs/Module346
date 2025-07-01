<?php
use App\Models\Restaurant;

?>

<div class="restaurants-list-container">
    <ul class="restaurants-list">
        <?php foreach ($restaurants as $restaurant) { ?>
            <li class="restaurants-list-item">
                <?php
                    echo $restaurant->name;
                ?>
            </li>
        <?php } ?>
    </ul>
</div>

<?php ?>
