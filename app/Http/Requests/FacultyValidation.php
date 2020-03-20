<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyValidation extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|max:100|unique:faculties,name',
                    'code' => 'required|max:10|unique:faculties,code'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:100|unique:faculties,name,' . $this->route('faculty'),
                    'code' => 'required|max:10|unique:faculties,code,' . $this->route('faculty'),
                ];
            default:
                return [];
        }
    }
}
