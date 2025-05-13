<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHargaKomoditasHarianKabkotaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kode_kab'     => 'required|exists:master_administrasi,kd_adm',
            'waktu'        => 'required|date',
            'id_komoditas' => 'required|exists:master_komoditas,id_kmd',
            'harga'        => 'required|integer|min:0',
            'source'       => 'nullable|string|max:255',
        ];
    }
}
