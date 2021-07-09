<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'nama_produk' => 'required|string|min:3|max:255',
            'kategori' => 'required|string|min:3|max:255',
            'deskripsi' => 'required|string|min:3',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'harga' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nama_produk.required' => 'Nama Produk tidak boleh kosong',
            'nama_produk.min' => 'Nama Produk tidak boleh kurang dari 3 huruf',
            'nama_produk.max' => 'Nama Produk tidak boleh lebih dari 255 huruf',
            'nama_produk.unique' => 'Nama Produk tidak boleh sama',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.min' => 'Kategori tidak boleh kurang dari 3 huruf',
            'kategori.max' => 'Kategori tidak boleh lebih dari 255 huruf',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.min' => 'Deskripsi tidak boleh kurang dari 3 huruf',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.numeric' => 'Stok hanya berupa angka',
            'berat.required' => 'Berat tidak boleh kosong',
            'berat.numeric' => 'Berat hanya berupa angka',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga hanya berupa angka',
        ];
    }
}
