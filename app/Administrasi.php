<?php
// app/Models/Administrasi.php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    // tetap tabel master_administrasi
    protected $table = 'master_administrasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kd_adm',
        'wilayah_adm',
        'nm_adm',
        'source',
    ];
}
