<?php

namespace App\Models;

use App\Komoditas;
use Illuminate\Database\Eloquent\Model;

class NeracaKetersediaanPangan extends Model
{
    protected $table = 'neraca_ketersediaan_pangan';
    protected $fillable = ['kode_kab', 'id_komoditas', 'quantity_kg', 'date'];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas', 'id_kmd');
    }

    public function administrasi()
    {
        return $this->belongsTo(Komoditas::class, 'kode_kab', 'kd_adm');
    }
}
