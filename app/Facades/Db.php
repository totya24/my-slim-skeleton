<?php
namespace App\Facades;

use SlimFacades\Facade;

class Db extends Facade
{
    public static function self()
    {
        return self::$app->getContainer()->get('db');
    }
}