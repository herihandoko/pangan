<?php

namespace App;

use App\Model\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function opd(): HasOne
    {
        return $this->hasOne(Opd::class, 'id', 'opd_id');
    }
    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'code', 'sub_unit');
    }
}
