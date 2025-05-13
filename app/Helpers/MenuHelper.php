<?php

namespace App\Helpers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use DB;

use App\Model\Menus;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

/**
 * Description of MenuHelper
 *
 * @author heryhandoko
 */
class MenuHelper
{
    public static function print_menu_editor($menu)
    {
        $editing = \Collective\Html\FormFacade::open(['route' => ['settings.menus.destroy', $menu->id], 'method' => 'DELETE', 'style' => 'display:inline']);
        $editing .= '<button class="btn btn-xs btn-danger pull-right btn-menu-remove"><i class="fa fa-times"></i></button>';
        $editing .= \Collective\Html\FormFacade::close();
        if ($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;
            $info->icon = $menu->icon;

            //$editing .= '<a class="editMenuBtn btn btn-xs btn-success pull-right" info=\'' . json_encode($info) . '\'><i class="fa fa-edit"></i></a>';
        }
        $str = '<li class="dd-item dd3-item" data-id="' . $menu->id . '">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"><i class="fa ' . $menu->icon . '"></i> ' . $menu->name . ' ' . $editing . '</div>';
        $childrens = \App\Model\Menus::select([
            'menus.id',
            'modules.name',
            'modules.url',
            'modules.fa_icon AS icon'
        ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')->where("menus.parent", $menu->id)->orderBy('menus.hierarchy', 'asc')->get();

        if (count($childrens) > 0) {
            $str .= '<ol class="dd-list">';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_menu_editor($children);
            }
            $str .= '</ol>';
        }
        $str .= '</li>';
        return $str;
    }

    public static function print_menu()
    {
        $menuItems = Menus::select([
            'menus.id',
            'modules.name',
            'modules.label',
            'modules.url',
            'modules.fa_icon AS icon',
            'menus.parent'
        ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')
            ->leftJoin('role_module', 'role_module.module_id', '=', 'modules.id')
            ->where("menus.parent", 0)
            ->where("role_module.role_id", Auth::user()->role_id)
            ->where("role_module.acc_view", 1)
            ->orderBy('menus.hierarchy', 'asc')
            ->get();
        $menuItem = [];
        foreach ($menuItems as $key) {
            $menuItem[] = static::print_child($key);
        }
        return $menuItem;
    }

    public static function print_child($menu)
    {
        $childrens = Menus::select([
            'menus.id',
            'modules.name',
            'modules.label',
            'modules.url',
            'modules.fa_icon AS icon',
            'menus.parent'
        ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')
            ->leftJoin('role_module', 'role_module.module_id', '=', 'modules.id')
            ->where("menus.parent", $menu->id)
            ->where("role_module.role_id", Auth::user()->role_id)
            ->where("role_module.acc_view", 1)
            ->orderBy('menus.hierarchy', 'asc')
            ->get();
        $menuItem = array();
        if (count($childrens) > 0) {
            foreach ($childrens as $children) {
                $menuItem[] = static::print_child($children);
            }
        }
        $star = '*';
        if ($menu['name'] == 'Polling') {
            $star = '';
        }
        if ($menuItem) {
            $str = array(
                'id' => $menu->id,
                'text' => $menu['label'],
                'icon' => $menu['icon'],
                'submenu' => $menuItem,
                'href' => $menu['url'],
                'class' => '',
                'type' => $menu['parent'],
                'route' => $menu['url'] . $star,
                'route_parent' => strtolower($menu['name']) . $star
            );
        } else {
            $str = array(
                'id' => $menu->id,
                'text' => $menu['label'],
                'url' => $menu['url'],
                'icon' => $menu['icon'],
                'href' => $menu['url'],
                'class' => '',
                'type' => $menu['parent'],
                'route' => $menu['url'] . $star,
                'route_parent' => strtolower($menu['name']) . $star
            );
        }

        return $str;
    }
}
