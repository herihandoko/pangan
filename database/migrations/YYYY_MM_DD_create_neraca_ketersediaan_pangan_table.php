<?php
// Migration: database/migrations/YYYY_MM_DD_create_neraca_ketersediaan_pangan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('neraca_ketersediaan_pangan', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_kab');
            $table->integer('id_komoditas');
            $table->decimal('quantity_kg', 20, 2);
            $table->date('date');
            $table->timestamps();

            $table->foreign('kode_kab')
                ->references('kd_adm')->on('master_administrasi')
                ->onDelete('cascade');

            $table->foreign('id_komoditas')
                ->references('id_kmd')->on('master_komoditas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('neraca_ketersediaan_pangan');
    }
};
