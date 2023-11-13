<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateConfigsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50);
            $table->string('section', 100)->nullable();
            $table->string('value', 255);
            $table->timestamps();
        });

        DB::table('configs')->insert([
            ['key' => 'sitename', 'value' => 'Short'],
            ['key' => 'sitename_part1', 'value' => 'RCTI'],
            ['key' => 'sitename_part2', 'value' => 'plus'],
            ['key' => 'sitename_short', 'value' => 'R+'],
            ['key' => 'site_description', 'value' => 'Short'],
            ['key' => 'sidebar_search', 'value' => 0],
            ['key' => 'show_messages', 'value' => 0],
            ['key' => 'show_notifications', 'value' => 0],
            ['key' => 'show_tasks', 'value' => 0],
            ['key' => 'show_rightsidebar', 'value' => 0],
            ['key' => 'skin', 'value' => 'skin-white'],
            ['key' => 'layout', 'value' => 'fixed'],
            ['key' => 'default_email', 'value' => 'info@mncplus.com'],
            ['key' => 'body_small_text', 'value' => 'on'],
            ['key' => 'navbar_variants', 'value' => 'main-header navbar navbar-expand navbar-dark navbar-primary'],
            ['key' => 'dark_mode', 'value' => 'on'],
            ['key' => 'header_styling', 'value' => 'inverse'],
            ['key' => 'header', 'value' => 'fixed'],
            ['key' => 'sidebar_styling', 'value' => 'default'],
            ['key' => 'sidebar', 'value' => 'fixed'],
            ['key' => 'sidebar_gradient', 'value' => 'disabled'],
            ['key' => 'content_styling', 'value' => 'default'],
            ['key' => 'sidebar_transparent', 'value' => '0'],
            ['key' => 'sidebar_light', 'value' => '0'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
