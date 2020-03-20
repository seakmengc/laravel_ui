<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IdentityValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:50|alpha_dash',
            'last_name' => 'required|max:50|alpha_dash',
            'dob' => 'required|date|before:today',
            'email'=>'required|email|max:100',
            'phone_number'=>'required|digits_between:8,10',
        ];
    }
}
