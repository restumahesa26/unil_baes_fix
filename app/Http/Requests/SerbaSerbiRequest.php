<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerbaSerbiRequest extends FormRequest
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
            'serba_serbi' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'serba_serbi.required' => 'Serba-Serbi tidak boleh kosong',
            'serba_serbi.min' => 'Serba-Serbi tidak boleh kurang dari 3 huruf',
        ];
    }
}
