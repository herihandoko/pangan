<?php
// app/Http/Requests/StoreAdministrasiRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministrasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kd_adm'      => 'required|integer|unique:master_administrasi,kd_adm',
            'wilayah_adm' => 'required|string|max:255',
            'nm_adm'      => 'required|string|max:255',
            'source'      => 'nullable|string|max:255',
        ];
    }
}
