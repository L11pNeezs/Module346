<?php

namespace App\Libraries\Core;

class UserFaker
{
    private static array $usernames = [
        'goat.dev',
        'luna.techie',
        'max_power23',
        'nova.alpha',
        'skywalker7'
    ];
    private static array $passwords = [
        'P@ssw0rd123',
        'Zebra!2025',
        'Qwerty_89!',
        'L1ipSecure*',
        'Moonlight$7'
    ];
    private static array $names = [
        'Goat',
        'Luna',
        'Max',
        'Sophie',
        'Leo'
    ];
    private static array $surnames = [
        'Dev',
        'Meier',
        'Schmid',
        'Keller',
        'Baumann'
    ];
    private static array $emails = [
        'goat.dev@example.com',
        'luna.meier@example.com',
        'max.schmid@example.com',
        'sophie.keller@example.com',
        'leo.baumann@example.com'
    ];

    public static function username(): string
    {
        return self::$usernames[array_rand(self::$usernames)];
    }

    public static function password(): string
    {
        return self::$passwords[array_rand(self::$passwords)];
    }

    public static function name(): string
    {
        return self::$names[array_rand(self::$names)];
    }

    public static function surname(): string
    {
        return self::$surnames[array_rand(self::$surnames)];
    }

    public static function email(): string
    {
        return self::$emails[array_rand(self::$emails)];
    }
}
