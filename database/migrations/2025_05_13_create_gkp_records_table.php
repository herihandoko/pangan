<?php
// Migration: database/migrations/YYYY_MM_DD_create_gkp_records_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gkp_records', function (Blueprint $table) {
            $table->id();
            $table->string('level'); // e.g. 'petani'
            $table->integer('id_komoditas')->nullable();
            $table->string('period'); // e.g. 'weekly'
            $table->string('week');   // e.g. 'MG I', 'MG II', ...
            $table->integer('count');
            $table->decimal('hpp_nasional', 15, 2);
            $table->date('date');
            $table->timestamps();

            $table->foreign('id_komoditas')
                ->references('id_kmd')->on('master_komoditas')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gkp_records');
    }
};
