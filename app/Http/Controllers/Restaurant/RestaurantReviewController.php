<?php

namespace App\Http\Controllers\Restaurant;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\RestaurantReviews;

class RestaurantReviewController extends AbstractController
{
    public function rateRestaurant(): string
    {
        $userId = $_SESSION['id'] ?? null;

        if (! isset($userId)) {
            return json_encode(['error' => 'You need to log in first']);
        }

        $data = request()->all();
        $restaurantId = (int) $data['id'];
        $rating = (int) $data['rating'];
        $comment = trim($data['comment']);

        if ($rating < 1 || $rating > 5) {
            return json_encode(['error' => 'Rating must be between 1 and 5']);
        }

        $success = RestaurantReviews::addRating($restaurantId, $rating, $userId, $comment);

        if (! $success) {
            return json_encode(['error' => 'Something went wrong']);
        }

        return json_encode(['success' => true]);
    }

    public function reviews(): string
    {
        $data = request()->all();
        $restaurantId = (int) $data['restaurant_id'];

        if ($restaurantId <= 0) {
            return json_encode(['error' => 'Invalid Restaurant ID']);
        }

        $reviews = RestaurantReviews::getReviews($restaurantId);

        if (empty($reviews)) {
            return json_encode(['error' => 'No reviews']);
        }

        return view('restaurant_reviews', [
            'reviews' => $reviews,
            'restaurantId' => $restaurantId,
        ]);
    }

    public function updateReview(): string
    {
        $data = request()->all();
        $reviewId = $data['id'];
        $rating = $data['rating'];
        $comment = trim($data['comment']);

        if ($reviewId <= 0 || $rating < 1 || $rating > 5) {
            return json_encode(['error' => 'Rating must be between 1 and 5']);
        }

        $review = RestaurantReviews::getReviewById($reviewId);

        if (! $review || $review['user_id'] != $_SESSION['id']) {
            return json_encode(['error' => 'You need to log in first']);
        }

        $success = RestaurantReviews::updateReview($reviewId, $rating, $comment);
        if (! $success) {
            return json_encode(['error' => 'Failed to update review']);
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
        $reviewId = $data['id'];
        $restaurantId = (int) $data['restaurant_id'] ?? null;

        if ($restaurantId <= 0) {
            return view('restaurant_reviews', [
                'reviews' => [],
                'restaurantId' => $restaurantId,
                'error' => 'Invalid Restaurant ID',
            ]);
        }

        $success = RestaurantReviews::deleteReview($reviewId);

        if (! $success) {
            return view('restaurant_reviews', [
                'reviews' => [],
                'restaurantId' => $restaurantId,
                'error' => 'Failed to delete review',
            ]);
        }

        // $reviews = RestaurantReviews::getReviews($restaurantId);

        header('Location: /restaurant_reviews?restaurant_id='.$restaurantId);
        exit;
    }
}
