<?php

namespace App\Utils;

class RoleUtil
{
    const ADMIN = 'admin';
    const USER = 'user';

    public static function getAllRoles()
    {
        return [
            self::ADMIN,
            self::USER,
        ];
    }
}