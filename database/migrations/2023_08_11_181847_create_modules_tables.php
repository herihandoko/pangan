<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateModulesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('code', 255)->nullable();
            $table->string('label', 255);
            $table->string('url', 500);
            $table->string('fa_icon', 64);
            $table->string('src', 255)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        DB::table('modules')->insert([
            [
                'id' => '1',
                'name' => 'Dashboard',
                'code' => 'dashboard',
                'label' => 'Dashboard',
                'url' => '/',
                'fa_icon' => 'fa fa-laptop',
            ], [
                'id' => '2',
                'name' => 'Users',
                'code' => 'users',
                'label' => 'Users',
                'url' => 'settings/users',
                'fa_icon' => 'fa fa-circle',
            ], [
                'id' => '3',
                'name' => 'Menus',
                'code' => 'menus',
                'label' => 'Menus',
                'url' => 'settings/menus',
                'fa_icon' => 'fa fa-circle',
            ], [
                'id' => '4',
                'name' => 'Configs',
                'code' => 'configs',
                'label' => 'Configs',
                'url' => 'settings/configs',
                'fa_icon' => 'fa fa-circle',
            ], [
                'id' => '5',
                'name' => 'Roles',
                'code' => 'roles',
                'label' => 'Roles',
                'url' => 'settings/roles',
                'fa_icon' => 'fa fa-circle',
            ], [
                'id' => '6',
                'name' => 'Settings',
                'code' => 'settings',
                'label' => 'Settings',
                'url' => '#',
                'fa_icon' => 'fa fa-cogs',
            ], [
                'id' => '7',
                'name' => 'Modules',
                'code' => 'modules',
                'label' => 'Modules',
                'url' => 'settings/modules',
                'fa_icon' => 'fa fa-circle',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
