<?php

namespace App\Models;

use App\Administrasi;
use App\Komoditas;
use Illuminate\Database\Eloquent\Model;

class HargaKomoditasHarianKabkota extends Model
{
    protected $table = 'harga_komoditas_harian_kabkota';
    protected $primaryKey = 'id';
    public $timestamps = true; // created_at & updated_at

    protected $fillable = [
        'kode_kab',
        'waktu',
        'id_komoditas',
        'harga',
        'source',
    ];

    // relasi ke MasterAdministrasi
    public function administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'kode_kab', 'kd_adm');
    }

    // relasi ke MasterKomoditas
    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas', 'id_kmd');
    }
}
