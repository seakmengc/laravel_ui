<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentValidation extends FormRequest
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
                    'code' => 'required|max:10|unique:departments',
                    'name' => 'required|max:100|unique:departments',
                    'faculty_id' => 'required|exists:faculties,id'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'code' => 'required|max:10|unique:departments,code,' . $this->route('department'),
                    'name' => 'required|max:100|unique:departments,name,' . $this->route('department'),
                    'faculty_id' => 'required|exists:faculties,id'
                ];
            default:
                return [];
        }
    }
}
