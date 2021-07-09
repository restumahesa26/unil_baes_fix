<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KamusRequest extends FormRequest
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
            'kata_kunci' => 'required|string|min:2|max:255',
            'terjemahan' => 'required|string|min:2|max:255'
        ];
    }

    public function messages()
    {
        return [
            'kata_kunci.required' => 'Kata Kunci tidak boleh kosong',
            'kata_kunci.min' => 'Kata Kunci tidak boleh kurang dari 3 huruf',
            'kata_kunci.max' => 'Kata Kunci tidak boleh lebih dari 255 huruf',
            'terjemahan.required' => 'Terjemahan tidak boleh kosong',
            'terjemahan.min' => 'Terjemahan tidak boleh kurang dari 3 huruf',
            'terjemahan.max' => 'Terjemahan tidak boleh lebih dari 255 huruf',
        ];
    }
}
