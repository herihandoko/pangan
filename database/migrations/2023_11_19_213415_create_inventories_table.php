<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255);
            $table->string('name', 255);
            $table->string('version', 18);
            $table->string('user_base', 100);
            $table->string('scope', 20);
            $table->string('keterangan', 1000);
            $table->string('opd_id', 32);
            $table->integer('category_id');
            $table->string('url', 500);
            $table->string('tahun_anggaran', 4);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->string('status', 18);
            $table->string('platform', 18);
            $table->string('manufacturer', 255);
            $table->integer('server_id');
            $table->string('type_hosting', 255);
            $table->integer('predecessor_app');
            $table->string('sub_unit', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
