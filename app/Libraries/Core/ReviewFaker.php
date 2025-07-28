<?php

namespace App\Libraries\Core;

class ReviewFaker
{

private static array $restaurantIds = [
        1, 2, 3, 4, 5,
    ];

    private static array $userIds = [
        1, 2, 3, 4, 5,
    ];

    private static array $ratings = [
        1, 2, 3, 4, 5,
    ];

    private static array $comments = [
        'Amazing food and great service!',
        'The ambiance was perfect for a date night.',
        'Loved the vegan options available.',
        'A bit pricey but worth every penny.',
        'Will definitely come back for more!',
    ];

    public static function restaurantId(): int
    {
        return self::$restaurantIds[array_rand(self::$restaurantIds)];
    }

    public static function userId(): int
    {
        return self::$userIds[array_rand(self::$userIds)];
    }

    public static function rating(): int
    {
        return self::$ratings[array_rand(self::$ratings)];
    }

    public static function comment(): string
    {
        return self::$comments[array_rand(self::$comments)];
    }
}
