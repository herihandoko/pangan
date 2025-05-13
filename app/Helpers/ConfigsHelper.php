<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers;
//use DB;

/**
 * Description of MenuHelper
 *
 * @author heryhandoko
 */
class ConfigsHelper
{
    //put your code here
    public static function getByKey($key)
    {
        return \App\Model\Configs::getByKey($key);
    }
}
