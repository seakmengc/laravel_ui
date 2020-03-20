<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd($this->request->all());
        return [
            'username' => 'required|max:30|unique:users|alpha_dash',
            'password' => 'required|max:100|confirmed',
            'first_name' => 'required|max:50|alpha',
            'last_name' => 'required|max:50|alpha',
            'dob' => 'required|before:today',
            'email' => 'required|email|max:100',
            'phone_number' => 'required|digits_between:8,10',
            'roles' => 'array',
            'roles.*' => ['exists:roles,name', Rule::notIn(['admin'])]
        ];
    }

    public function validatedUserData()
    {
        $validated = parent::validated();

        return [
            'username' => $validated['username'],
            'password' => bcrypt($validated['password'])
        ];
    }

    public function validatedRolesData()
    {
        $validated = parent::validated();

        return [
            'roles' => $validated['roles'],
        ];
    }

    public function validatedIdentityData()
    {
        $validated = parent::validated();

        unset($validated['username']);
        unset($validated['password']);
        unset($validated['roles']);

        return $validated;
    }
}
