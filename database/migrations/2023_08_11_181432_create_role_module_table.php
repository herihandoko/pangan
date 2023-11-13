<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoleModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role_module', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->integer('module_id');
            $table->tinyInteger('acc_view');
            $table->tinyInteger('acc_create');
            $table->tinyInteger('acc_edit');
            $table->tinyInteger('acc_delete');
            $table->timestamps();
        });

        DB::table('role_module')->insert([
            [
                'role_id' => '1',
                'module_id' => '1',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '2',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '3',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '4',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '5',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '6',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
            ], [
                'role_id' => '1',
                'module_id' => '7',
                'acc_view' => '1',
                'acc_create' => '1',
                'acc_edit' => '1',
                'acc_delete' => '1'
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
        //
        Schema::dropIfExists('role_module');
    }
}
