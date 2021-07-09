<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekeningRequest extends FormRequest
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
            'nama_rekening' => 'required|string|min:3|max:255',
            'nomor_rekening' => 'required|string|min:3|max:255',
            'atas_nama' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nama_rekening.required' => 'Nama Rekening tidak boleh kosong',
            'nama_rekening.min' => 'Nama Rekening tidak boleh kurang dari 3 huruf',
            'nama_rekening.max' => 'Nama Rekening tidak boleh lebih dari 255 huruf',
            'nomor_rekening.required' => 'Nomor Rekening tidak boleh kosong',
            'nomor_rekening.min' => 'Nomor Rekening tidak boleh kurang dari 3 huruf',
            'nomor_rekening.max' => 'Nomor Rekening tidak boleh lebih dari 255 huruf',
            'atas_nama.required' => 'Atas Nama tidak boleh kosong',
            'atas_nama.min' => 'Atas Nama tidak boleh kurang dari 3 huruf',
            'atas_nama.max' => 'Atas Nama tidak boleh lebih dari 255 huruf',
        ];
    }
}
