<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'module_id',
        'hierarchy',
        'parent'
    ];

    public function storeData($input) {
        return static::create([
                    'module_id' => $input['module_id'],
                    'hierarchy' => 0,
                    'parent' => 0,
        ]);
    }

}
