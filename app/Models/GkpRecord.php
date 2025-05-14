<?php

namespace App\Models;

use App\Komoditas;
use Illuminate\Database\Eloquent\Model;

class GkpRecord extends Model
{
    protected $table = 'gkp_records';
    protected $fillable = [
        'level',
        'id_komoditas',
        'period',
        'week',
        'count',
        'hpp_nasional',
        'date'
    ];
    protected $dates = ['date'];

    public function komoditas()
    {
        return $this->belongsTo(Komoditas::class, 'id_komoditas', 'id_kmd');
    }
}
