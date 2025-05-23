<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\MenuHelper::class;
    }
}
