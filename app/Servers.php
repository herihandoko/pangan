<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Servers extends Model
{
    use HasFactory;

    public function hardware(): HasOne
    {
        return $this->hasOne(Hardware::class, 'id', 'id_hardware');
    }
}
