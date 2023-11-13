<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMenusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('parent');
            $table->integer('hierarchy');
            $table->timestamps();
        });

        DB::table('menus')->insert([
            [
                'id' => 1,
                'module_id' => 1,
                'parent' => 0,
                'hierarchy' => 1,
            ], [
                'id' => 2,
                'module_id' => 6,
                'parent' => 0,
                'hierarchy' => 2,
            ], [
                'id' => 3,
                'module_id' => 2,
                'parent' => 2,
                'hierarchy' => 1,
            ], [
                'id' => 4,
                'module_id' => 3,
                'parent' => 2,
                'hierarchy' => 2,
            ], [
                'id' => 5,
                'module_id' => 4,
                'parent' => 2,
                'hierarchy' => 3,
            ], [
                'id' => 6,
                'module_id' => 5,
                'parent' => 2,
                'hierarchy' => 4,
            ], [
                'id' => 7,
                'module_id' => 7,
                'parent' => 2,
                'hierarchy' => 5,
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
        Schema::dropIfExists('menus');
    }
}
