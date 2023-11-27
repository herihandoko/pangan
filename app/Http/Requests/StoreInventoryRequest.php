<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|unique:inventories,code|max:100',
            'version' => 'required',
            'url' => 'required',
            'category' => 'required',
            'status' => 'required',
            'manufacturer' => 'required',
            'tahun_anggaran' => 'required|date_format:Y',
            'opd_id' => 'required',
            'sub_unit' => 'required',
        ];
    }
}
