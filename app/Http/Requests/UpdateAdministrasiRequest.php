<?php
// app/Http/Requests/UpdateAdministrasiRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdministrasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('administrasi')->kd_adm;
        return [
            'kd_adm'      => "required|integer|unique:master_administrasi,kd_adm,{$id},kd_adm",
            'wilayah_adm' => 'required|string|max:255',
            'nm_adm'      => 'required|string|max:255',
            'source'      => 'nullable|string|max:255',
        ];
    }
}
