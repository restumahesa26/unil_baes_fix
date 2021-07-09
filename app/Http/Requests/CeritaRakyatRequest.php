<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CeritaRakyatRequest extends FormRequest
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
            'judul' => 'required|string|min:3|max:255',
            'deskripsi' => 'required|string|min:3',
            'isi_cerita' => 'required|string|min:3'
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul tidak boleh kurang dari 3 huruf',
            'judul.max' => 'Judul tidak boleh lebih dari 255 huruf',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.min' => 'Deskripsi tidak boleh kurang dari 3 huruf',
            'isi_cerita.required' => 'Isi Cerita tidak boleh kosong',
            'isi_cerita.min' => 'Isi Cerita tidak boleh kurang dari 3 huruf'
        ];
    }
}
