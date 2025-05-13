<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    // Nama tabel kustom
    protected $table = 'master_komoditas';

    // Primary key kustom
    protected $primaryKey = 'id_kmd';

    // Laravel tidak akan mencari updated_at/created_at default
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'update_at';

    // Override route key name sehingga binding pakai id_kmd, bukan 'id'
    public function getRouteKeyName()
    {
        return 'id_kmd';
    }

    protected $fillable = [
        'id_kmd',
        'nama_pangan',
        'hpp/het',
        'source',
    ];
}
