<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Facades\DB;

class RestaurantReviews extends Model
{
    public static function addRating(int $restaurantId, int $rating, int $userId, ?string $comment): bool
    {
        return DB::table('restaurant_reviews')->insert([
            'restaurant_id' => $restaurantId,
            'user_id' => $userId,
            'rating' => $rating,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function getReviews(int $restaurantId): array
    {
        $results = DB::table('restaurant_reviews')
            ->where('restaurant_id', '=', $restaurantId)
            ->orderBy('created_at', 'DESC')
            ->get();

        $reviews = [];
        foreach ($results as $result) {
            $reviews[] = [
                'id' => $result['id'],
                'restaurant_id' => $result['restaurant_id'],
                'user_id' => $result['user_id'],
                'rating' => $result['rating'],
                'comment' => $result['comment'],
                'created_at' => $result['created_at'],
            ];
        }

        return $reviews;
    }

    public static function getReviewById(int $reviewId): ?array
    {
        $result = DB::table('restaurant_reviews')
            ->where('id', '=', $reviewId)
            ->limit(1)
            ->get();

        return ! empty($result) ? $result[0] : null;
    }

    public static function updateReview(int $reviewId, int $rating, ?string $comment): bool
    {
        return DB::table('restaurant_reviews')
            ->where('id', '=', $reviewId)
            ->update([
                'rating' => $rating,
                'comment' => $comment,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }

    public static function deleteReview(int $reviewId): bool
    {
        return DB::table('restaurant_reviews')
            ->where('id', '=', $reviewId)
            ->delete();
    }
}
