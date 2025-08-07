<?php

namespace App\Libraries\Core;

class MenuFaker
{
    private static array $restaurantId = [
        1, 2, 3, 4, 5,
    ];

    private static array $menuItemId = [
        1, 2, 3, 4, 5,
    ];

    private static array $names = [
        'Lunch Special',
        'Dinner Delight',
        'Weekend Brunch',
        'Happy Hour MenuItem',
        'Seasonal Specials',
        'Chef\'s Choice',
    ];

    private static array $descriptions = [
        'A delightful selection of dishes for a perfect lunch break.',
        'An exquisite dinner menu featuring gourmet options.',
        'A relaxing brunch with a variety of sweet and savory dishes.',
        'Enjoy discounted drinks and appetizers during happy hour.',
        'Seasonal dishes crafted with the freshest ingredients.',
        'A surprise menu curated by our chef for the day.',
    ];

    private static array $prices = [
        15.99,
        25.50,
        18.75,
        10.00,
        30.00,
        22.50,
    ];

    private static array $ratings = [
        1, 2, 3, 4, 5,
    ];

    public static function restaurantId(): int
    {
        return self::$restaurantId[array_rand(self::$restaurantId)];
    }

    public static function menuItemId(): int
    {
        return self::$menuItemId[array_rand(self::$menuItemId)];
    }

    public static function name(): string
    {
        return self::$names[array_rand(self::$names)];
    }

    public static function description(): string
    {
        return self::$descriptions[array_rand(self::$descriptions)];
    }

    public static function price(): float
    {
        return self::$prices[array_rand(self::$prices)];
    }

    public static function rating(): int
    {
        return self::$ratings[array_rand(self::$ratings)];
    }
}
