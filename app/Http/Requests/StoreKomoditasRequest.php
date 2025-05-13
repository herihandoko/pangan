<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKomoditasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_kmd'      => 'required|integer|unique:master_komoditas,id_kmd',
            'nama_pangan' => 'required|string|max:255',
            'hpp/het'     => 'required|string|max:255',
            'source'      => 'required|string|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'hpp/het' => 'HPP/HET',
        ];
    }
}
