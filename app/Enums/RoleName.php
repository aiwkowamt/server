<?php

namespace App\Enums;

enum RoleName: int
{
    case ADMIN = 1;
    case CUSTOMER = 2;
    case STORE = 3;

    public static function getId(RoleName $role): int
    {
        return match ($role) {
            self::ADMIN => 1,
            self::CUSTOMER => 2,
            self::STORE => 3,
        };
    }
}
