<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHardwareRequest extends FormRequest
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
            'type' => 'required',
            'inventory_tag' => 'required|max:255',
            'harga' => 'required|numeric',
            'currency' => 'required',
            'manufacturer' => 'max:255',
            'brand' => 'max:255',
            'model' => 'max:255',
            'status' => 'required',
            'opd_id' => 'required|numeric',
            'tahun_anggaran' => 'required|date_format:Y',
            'purchase_date' => 'required|date_format:Y-m-d',
            'waranty_date' => 'nullable|date_format:Y-m-d',
            'serial_number' => 'required|max:255',
        ];
    }
}
