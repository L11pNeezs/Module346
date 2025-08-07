<?php

namespace App\Http\Controllers\Menu;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\MenuItemRating;

class MenuItemController extends AbstractController
{
    public function rateItem(): string
    {
        $data = request()->all();
        $menuItemId = (int) $data['id'] ?? null;
        $rating = (int) $data['rating'];
        $comment = trim($data['comment'] ?? '');

        if ($rating < 1 || $rating > 5) {
            return json_encode(['error' => 'Rating must be between 1 and 5.']);
        }

        if (! isset($_SESSION['id'])) {
            return json_encode(['error' => 'User not authenticated.']);
        }

        $success = MenuItemRating::addRating($menuItemId, $rating, $_SESSION['id'], $comment);

        if (! $success) {
            return json_encode(['error' => 'Failed to save rating.']);
        }

        return json_encode(['success' => true]);
    }

    public function reviews(): string
    {
        $data = request()->all();
        $menuItemId = (int) $data['menu_item_id'];

        if ($menuItemId <= 0) {
            return json_encode(['error' => 'Invalid menu item ID.']);
        }

        $reviews = MenuItemRating::getReviews($menuItemId);

        if (empty($reviews)) {
            return json_encode(['error' => 'No reviews found for this menu item.']);
        }

        return view('menu_reviews', [
            'reviews' => $reviews,
            'menuItemId' => $menuItemId,
        ]);
    }

    public function updateReview(): string
    {
        $data = request()->all();
        $reviewId = (int) ($data['id'] ?? 0);
        $rating = (int) ($data['rating'] ?? 0);
        $comment = trim($data['comment'] ?? '');

        if ($rating < 1 || $rating > 5) {
            return json_encode(['error' => 'Invalid input.']);
        }

        $review = MenuItemRating::getReviewById($reviewId);

        if ($review === null || $review['user_id'] !== $_SESSION['id']) {
            return json_encode(['error' => 'Unauthorized or review not found.']);
        }

        $success = MenuItemRating::updateReview($reviewId, $rating, $comment);

        if (! $success) {
            return json_encode(['error' => 'Failed to update review.']);
        }

        return json_encode([
            'success' => true,
            'review' => [
                'id' => $reviewId,
                'rating' => $rating,
                'comment' => $comment,
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function deleteReview(): string
    {
        $data = request()->all();
        $reviewId = (int) ($data['id'] ?? 0);
        $menuItemId = $data['menu_item_id'] ?? null;

        if ($reviewId <= 0) {
            return view('menu_reviews', [
                'reviews' => [],
                'menuItemId' => $menuItemId,
                'error' => 'Invalid review ID.',
            ]);
        }

        $review = MenuItemRating::getReviewById($reviewId);

        if ($review === null || $review['user_id'] !== $_SESSION['id']) {
            return view('menu_reviews', [
                'reviews' => [],
                'menuItemId' => $menuItemId,
                'error' => 'Unauthorized or review not found.',
            ]);
        }

        $success = MenuItemRating::deleteReview($reviewId);

        if (! $success) {
            return view('menu_reviews', [
                'reviews' => [],
                'menuItemId' => $menuItemId,
                'error' => 'Failed to delete review.',
            ]);
        }

        header('Location: /menu_reviews?menu_item_id='.$menuItemId);
        exit;
    }
}
