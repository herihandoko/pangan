<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateInventoryRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            //
            'id' => 'required',
            'name' => 'required|max:255',
            'code' => 'required|max:100|unique:inventories,code,' . $request->id,
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
