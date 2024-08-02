<?php

namespace App\Utils;

class PermissionUtil
{
    const PRODUCT_LIST = 'product-list';
    const PRODUCT_SHOW = 'product-show';
    const PRODUCT_CREATE = 'product-create';
    const PRODUCT_UPDATE = 'product-update';
    const PRODUCT_DELETE = 'product-delete';

    static $permissions = [
        self::PRODUCT_LIST => 'List & filter all products',
        self::PRODUCT_SHOW => 'Show an existing product',
        self::PRODUCT_CREATE => 'Create a new product',
        self::PRODUCT_UPDATE => 'Update an existing product',
        self::PRODUCT_DELETE => 'Delete an existing product',
    ];

    public static function getUserPermissions()
    {
        return [
            self::PRODUCT_LIST,
            self::PRODUCT_SHOW,
        ];
    }
}
