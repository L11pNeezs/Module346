<?php

use App\Models\User;

?>
<?php if (! empty($error)) { ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php } ?>
<?php
foreach ($reviews as $review) {
    $user = User::getById($review['user_id']);
    $canEdit = isset($_SESSION['id']) && $_SESSION['id'] == $review['user_id'];
    ?>
    <div class="flex justify_center" id="review-<?= $review['id'] ?>">
        <div class="review justify_center">
            <p><strong>User :</strong> <?= htmlspecialchars($user ? $user->username : 'Unknown') ?></p>
            <div class="review-content">
                <p><strong>Rating:</strong> <span
                        class="review-rating"><?= htmlspecialchars($review['rating']) ?></span></p>
                <p><strong>Comment:</strong> <span
                        class="review-comment"><?= htmlspecialchars($review['comment']) ?></span></p>
                <p><strong>Date:</strong> <span
                        class="review-date"><?= htmlspecialchars($review['created_at']) ?></span></p>
                <?php if ($canEdit) { ?>
                    <div class="review-actions">
                        <form method="post" action="/menu_reviews/delete_review">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($review['id']) ?>">
                            <input type="hidden" name="menu_item_id"
                                   value="<?= htmlspecialchars($review['menu_item_id']) ?>">
                            <button type="submit" class="btn">Delete</button>
                            <button type="button" class="btn edit-btn" data-review-id="<?= $review['id'] ?>"><a href="#" >Edit</a></button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <?php if ($canEdit) { ?>
                <form class="edit-review-form" data-review-id="<?= $review['id'] ?>" style="display:none;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($review['id']) ?>">
                    <label for="rating-<?= $review['id'] ?>">Rating:</label>
                    <select name="rating" id="rating-<?= $review['id'] ?>" required>
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option
                                value="<?= $i ?>" <?= $i == $review['rating'] ? 'selected' : '' ?>><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <div class="div-break-gap-medium"></div>
                    <label for="comment-<?= $review['id'] ?>">Comment:</label>
                    <textarea name="comment" id="comment-<?= $review['id'] ?>" rows="4" cols="50"
                              required><?= htmlspecialchars($review['comment']) ?></textarea>
                    <div class="div-break-gap-medium"></div>
                    <button type="submit" class="btn">Update</button>
                    <button type="button" class="btn cancel-edit" data-review-id="<?= $review['id'] ?>"><a href="#">Cancel</a></button>
                </form>
            <?php } ?>
        </div>
    </div>
<?php } ?>
