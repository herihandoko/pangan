<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    public function opd(): HasOne
    {
        return $this->hasOne(Opd::class, 'id', 'opd_id');
    }
}
