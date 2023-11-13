<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    
    protected $fillable = [
        'name',
        'label',
        'description',
        'guard_name'
    ];

    public function storeData($input)
    {
        return static::create([
            'name' => $input['name'],
            'label' => $input['label'],
            'description' => $input['description'],
            'guard_name' => $input['name'],
        ]);
    }
}
