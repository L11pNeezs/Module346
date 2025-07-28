<?php

namespace App\Libraries\Core;

class RestaurantFaker
{
    private static array $names = [
        'Food Lab',
        'Bite Hub',
        'Green Fork',
        'Savory Spoon',
        'Urban Bites',
        'Fusion Feast',
    ];

    private static array $addresses = [
        'Rue de Bourg 22, 1003 Lausanne',
        'Avenue d’Ouchy 45, 1006 Lausanne',
        'Place de la Gare 4, 1003 Lausanne',
        'Chemin des Fleurettes 10, 1007 Lausanne',
        'Boulevard de Grancy 27, 1006 Lausanne',
        'Avenue du Léman 5, 1005 Lausanne',
    ];

    private static array $coordinates = [
        'POINT(6.6336 46.5205)',
        'POINT(6.6319 46.5074)',
        'POINT(6.6292 46.5165)',
        'POINT(6.6203 46.5047)',
        'POINT(6.6297 46.5128)',
        'POINT(6.6360 46.5150)',
    ];

    private static array $descriptions = [
        'fresh organic local produce',
        'authentic seasonal fusion dishes',
        'classic street-inspired spicy food',
        'hearty premium Swiss comfort',
        'crunchy sweet vibrant greens',
        'modern bold creative bites',
    ];

    private static array $images = [
        '/assets/images/black_tap.jpg',
        '/assets/images/chez_mario.jpg',
        '/assets/images/doki_doki.jpg',
        '/assets/images/holy_cow.jpg',
        '/assets/images/nil_bleu.jpg',
        '/assets/images/non_solo.jpg',
    ];

    private static array $priceTiers = [
        '$',
        '$$',
        '$$$',
    ];

    private static array $ptDescriptions = [
        'budget friendly daily meals',
        'affordable tasty quick food',
        'gourmet mid-range dining option',
        'exclusive high-end culinary trip',
        'value for great experience',
        'cheap delicious menu picks',
    ];

    private static array $concepts = [
        'Italian',
        'Vegan',
        'Japanese',
        'Mexican',
        'Hamburger',
        'Other',
    ];

    private static array $cDescriptions = [
        'fast bold authentic experience',
        'elevated artistic plated meals',
        'green ethical clean eating',
        'mobile tasty local popups',
        'juicy crafted layered patties',
        'zesty modern flavor blends',
    ];

    private static array $diets = [
        'Vegetarian',
        'Vegan',
        'Gluten-Free',
        'Flexitarian',
        'Other',
    ];

    private static array $dDescriptions = [
        'plant based healthy lifestyle',
        'strict animal-free nutrition',
        'no wheat just freshness',
        'low carb high fat rules',
        'faith-based certified meals',
        'light meals without sugars',
    ];

    private static array $veganOptions = [
        1,
        0
    ];

    private static array $veganOptionDescriptions = [
        '100% plant-based menu',
        'vegan-friendly options available',
        'vegan dishes on request',
        'no vegan options currently',
        'vegan meals not offered',
        'vegan-friendly upon request',
    ];

    public static function name(): string
    {
        return self::$names[array_rand(self::$names)];
    }

    public static function address(): string
    {
        return self::$addresses[array_rand(self::$addresses)];
    }

    public static function coordinates(): string
    {
        return self::$coordinates[array_rand(self::$coordinates)];
    }

    public static function description(): string
    {
        return self::$descriptions[array_rand(self::$descriptions)];
    }

    public static function image(): string
    {
        return self::$images[array_rand(self::$images)];
    }

    public static function priceTier(): string
    {
        return self::$priceTiers[array_rand(self::$priceTiers)];
    }

    public static function ptDescription(): string
    {
        return self::$ptDescriptions[array_rand(self::$ptDescriptions)];
    }

    public static function concept(): string
    {
        return self::$concepts[array_rand(self::$concepts)];
    }

    public static function cDescription(): string
    {
        return self::$cDescriptions[array_rand(self::$cDescriptions)];
    }

    public static function diet(): string
    {
        return self::$diets[array_rand(self::$diets)];
    }

    public static function dDescription(): string
    {
        return self::$dDescriptions[array_rand(self::$dDescriptions)];
    }
    public static function veganOption(): int
    {
        return self::$veganOptions[array_rand(self::$veganOptions)];
    }
    public static function veganOptionDescription(): string
    {
        return self::$veganOptionDescriptions[array_rand(self::$veganOptionDescriptions)];
    }
}
