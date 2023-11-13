<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Configs extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = [
        "key", "value", 'updated_by'
    ];

    public static function getByKey($key) {
        $row = Configs::where('key', $key)->first();
        if (isset($row->value)) {
            return $row->value;
        } else {
            return false;
        }
    }

    public static function getAll() {
        $configs = array();
        $configs_db = Configs::all();
        foreach ($configs_db as $row) {
            $configs[$row->key] = $row->value;
        }
        return (object) $configs;
    }

    public function updatedBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

}
