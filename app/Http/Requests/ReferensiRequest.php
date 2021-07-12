<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReferensiRequest extends FormRequest
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
            'jml_penduduk' => 'required|numeric',
            'luas_desa' => 'required|numeric',
            'jarak_kecamatan' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'jml_penduduk.required' => 'Jumlah Penduduk tidak boleh kosong',
            'jml_penduduk.numeric' => 'Jumlah Penduduk hanya berupa angka',
            'luas_desa.required' => 'Luas Desa tidak boleh kosong',
            'luas_desa.numeric' => 'Luas Desa hanya berupa angka',
            'jarak_kecamatan.required' => 'Jarak Ke Kecamatan tidak boleh kosong',
            'jarak_kecamatan.numeric' => 'Jarak Ke Kecamatan hanya berupa angka',
        ];
    }
}
