<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHardwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
            $table->string('inventory_tag', 255)->nullable();
            $table->string('barcode', 255)->nullable();
            $table->decimal('harga', 9, 2)->nullable();
            $table->string('currency', 4)->nullable();
            $table->string('manufacturer', 255)->nullable();
            $table->string('brand', 255)->nullable();
            $table->string('model', 255)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('waranty_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('opd_id')->nullable();
            $table->string('serial_number',255)->nullable();
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
        Schema::dropIfExists('hardware');
    }
}
