<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WisataRequest extends FormRequest
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
            'nama_wisata' => 'required|string|min:3|max:255',
            'deskripsi' => 'required|string|min:3',
            'ketentuan' => 'required|string',
            'fasilitas' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|min:3|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nama_wisata.required' => 'Nama Wisata tidak boleh kosong',
            'nama_wisata.min' => 'Nama Wisata tidak boleh kurang dari 3 huruf',
            'nama_wisata.max' => 'Nama Wisata tidak boleh lebih dari 255 huruf',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.min' => 'Deskripsi tidak boleh kurang dari 3 huruf',
            'ketentuan.required' => 'Ketentuan tidak boleh kosong',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong',
            'fasilitas.max' => 'Fasilitas tidak boleh lebih dari 255 huruf',
            'harga.required' => 'Berat tidak boleh kosong',
            'harga.numeric' => 'Berat hanya berupa angka',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.min' => 'Kategori tidak boleh kurang dari 3 huruf',
            'kategori.max' => 'Kategori tidak boleh lebih dari 255 huruf',
        ];
    }
}
