<?php
/** @var \App\Models\Restaurant[] $restaurants */
/** @var int $pageNumber */
/** @var int $nbPages */
?>
<?php foreach ($restaurants as $restaurant) { ?>
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
                    <p class="span"><img src="/assets/images/price-tiers/<?= $restaurant->price_tier ?>.png"</p>
                </div>
                <div class="icon-box">
                    <p class="span"><img src="/assets/images/food-icons/<?= $restaurant->concept ?>.svg"></p>
                </div>
                <div class="icon-box">
                    <?php if ($restaurant->veggie_option) { ?>
                        <p class="span"><img src="/assets/images/vegan.png"></p>
                    <?php } else { ?>
                        <p class="span"><img src="/assets/images/vegan-red.png"></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php
$adjacentNumber = 2;
$pageNumber = min($pageNumber, $pageNumber);
$startPage = max(1, $pageNumber - $adjacentNumber);
$endPage = min($nbPages, $pageNumber + $adjacentNumber);
?>

<ul class="pagination-container pagination">
    <?php if ($pageNumber > 1) { ?>
        <li><a href="javascript:;" data-page="1" class="first">&laquo;</a></li>
    <?php } ?>

    <?php if ($startPage > 1) { ?>
        <li><a href="javascript:;" data-page="<?= $pageNumber - 1 ?>" class="previous pagination-dots">&lsaquo;</a></li>
        <li class="pagination-dots"> ...</li>
    <?php } ?>

    <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
        <li class="pages">
            <a href="javascript:;" data-page="<?= $i ?>" class="<?= $i == $pageNumber ? 'current' : '' ?>">
                <?= $i ?>
            </a>
        </li>
    <?php } ?>

    <?php if ($endPage < $nbPages) { ?>
        <li class="pagination-dots"> ...</li>
        <li><a href="javascript:;" data-page="<?= $pageNumber + 1 ?>" class="next pagination-dots">&rsaquo;</a></li>
    <?php } ?>

    <?php if ($pageNumber < $nbPages) { ?>
        <li><a href="javascript:;" data-page="<?= $nbPages ?>" class="last">&raquo;</a></li>
    <?php } ?>
</ul>

