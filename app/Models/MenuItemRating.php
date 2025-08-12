<?php

namespace App\Models;

use App\Libraries\Core\Database\Model;
use App\Libraries\Core\Facades\DB;

class MenuItemRating extends Model
{
    public static function addRating(int $menuId, int $rating, int $userId, ?string $comment): bool
    {
        return DB::table('menu_item_ratings')->insert([
            'menu_item_id' => $menuId,
            'rating' => $rating,
            'user_id' => $userId,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function getFavoriteMenuItem(int $restaurantId): ?MenuItem
    {
        $results = DB::table('menu_items as mi')
            ->selectRaw('mi.*, AVG(mir.rating) as avg_rating')
            ->join('menu_item_ratings as mir', 'mi.id', '=', 'mir.menu_item_id')
            ->where('mi.restaurant_id', '=', $restaurantId)
            ->groupBy('mi.id')
            ->orderBy('avg_rating', 'DESC')
            ->limit(1)
            ->get();

        if (! empty($results)) {
            $favorite = new MenuItem;
            $favorite->fillFromArray((array) $results[0]);

            return $favorite;
        }

        return null;
    }

    public static function getReviews(int $menuItemId): array
    {
        $results = DB::table('menu_item_ratings')
            ->where('menu_item_id', '=', $menuItemId)
            ->orderBy('created_at', 'DESC')
            ->get();

        $reviews = [];
        foreach ($results as $result) {
            $reviews[] = [
                'id' => $result['id'],
                'user_id' => $result['user_id'],
                'rating' => $result['rating'],
                'comment' => $result['comment'],
                'created_at' => $result['created_at'],
                'menu_item_id' => $result['menu_item_id'],
            ];
        }

        return $reviews;
    }

    public static function getReviewById(int $reviewId): ?array
    {
        $result = DB::table('menu_item_ratings')
            ->where('id', '=', $reviewId)
            ->limit(1)
            ->get();

        return ! empty($result) ? (array) $result[0] : null;
    }

    public static function updateReview(int $reviewId, int $rating, ?string $comment): bool
    {
        return DB::table('menu_item_ratings')
            ->where('id', '=', $reviewId)
            ->update([
                'rating' => $rating,
                'comment' => $comment,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }

    public static function deleteReview(int $reviewId): bool
    {
        return DB::table('menu_item_ratings')
            ->where('id', '=', $reviewId)
            ->delete();
    }
}
