<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKomoditasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('komoditas')->id_kmd;
        return [
            'id_kmd'      => "required|integer|unique:master_komoditas,id_kmd,{$id},id_kmd",
            'nama_pangan' => 'nullable|string|max:255',
            'hpp/het'     => 'nullable|string|max:255',
            'source'      => 'nullable|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'hpp/het' => 'HPP/HET',
        ];
    }
}
