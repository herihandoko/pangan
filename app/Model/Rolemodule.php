<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Rolemodule extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'role_module';

    protected $fillable = [
        'id',
        'role_id',
        'module_id',
        'acc_view',
        'acc_create',
        'acc_edit',
        'acc_delete'
    ];
}
