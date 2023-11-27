<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Configs;

class ConfigsController extends Controller
{

    var $skin_array = [
        'White Skin' => 'skin-white',
        'Blue Skin' => 'skin-blue',
        'Black Skin' => 'skin-black',
        'Purple Skin' => 'skin-purple',
        'Yellow Sking' => 'skin-yellow',
        'Red Skin' => 'skin-red',
        'Green Skin' => 'skin-green'
    ];
    var $layout_array = [
        'Fixed Layout' => 'fixed',
        'Boxed Layout' => 'layout-boxed',
        'Top Navigation Layout' => 'layout-top-nav',
        'Sidebar Collapse Layout' => 'sidebar-collapse',
        'Mini Sidebar Layout' => 'sidebar-mini'
    ];
    var $navbar_variants = [
        'Navbar Primary' => 'main-header navbar navbar-expand navbar-dark navbar-primary',
        'Navbar Secondary' => 'main-header navbar navbar-expand navbar-dark navbar-secondary',
        'Navbar Info' => 'main-header navbar navbar-expand navbar-dark navbar-info',
        'Navbar Success' => 'main-header navbar navbar-expand navbar-dark navbar-success',
        'Navbar Danger' => 'main-header navbar navbar-expand navbar-dark navbar-danger',
        'Navbar Indigo' => 'main-header navbar navbar-expand navbar-dark navbar-indigo',
        'Navbar Purple' => 'main-header navbar navbar-expand navbar-dark navbar-purple',
        'Navbar Pink' => 'main-header navbar navbar-expand navbar-dark navbar-pink',
        'Navbar Navy' => 'main-header navbar navbar-expand navbar-dark navbar-navy',
        'Navbar Lightblue' => 'main-header navbar navbar-expand navbar-dark navbar-lightblue',
        'Navbar Gray' => 'main-header navbar navbar-expand navbar-dark navbar-gray',
        'Navbar White' => 'main-header navbar navbar-expand navbar-light navbar-white',
    ];
    private $moduleCode = 'configs';
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $this->authorize('view', $this->moduleCode);
        $configs = Configs::getAll();
        return View('settings.configs.index', [
            'configs' => $configs,
            'skins' => $this->skin_array,
            'layouts' => $this->layout_array,
            'variantsnav' => $this->navbar_variants
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('edit', $this->moduleCode);
        $validator = \Validator::make($request->all(), [
            'sitename' => ['required', 'max:64'],
            'sitename_part1' => ['required', 'max:18'],
            'sitename_part2' => ['required', 'max:18'],
            'sitename_short' => ['required', 'max:2'],
            'site_description' => ['required', 'max:140'],
            'header_styling' => ['required', 'max:18'],
            'header' => ['required', 'max:18'],
            'sidebar_styling' => ['required', 'max:18'],
            'sidebar' => ['required', 'max:18'],
            'sidebar_gradient' => ['required', 'max:18'],
            'content_styling' => ['required', 'max:18'],
            'default_email' => ['required', 'max:100'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $all = $request->all();
        foreach (['sidebar_search', 'show_messages', 'show_notifications', 'show_tasks', 'show_rightsidebar', 'sidebar_transparent', 'sidebar_light'] as $key) {
            if (!isset($all[$key])) {
                $all[$key] = 0;
            } else {
                $all[$key] = 1;
            }
        }
        foreach ($all as $key => $value) {
            Configs::where('key', $key)->update(['value' => $value]);
        }

        return response()->json([
            "success" => true
        ], 200);
    }
}
