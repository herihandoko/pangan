<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Configs extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\ConfigsHelper::class;
    }
}
