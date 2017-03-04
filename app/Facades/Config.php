<?php
namespace App\Facades;

use SlimFacades\Facade;

class Config extends Facade
{
    public static function self()
    {
        return self::$app;
    }

    public static function get($key = null)
    {
        if ($key === null) {
            return self::self()->getContainer();
        } else {
            return self::self()->getContainer()[$key];
        }
    }
}