<?php

namespace App\Http\Requests;

use App\Rules\ValidAcademic;
use Illuminate\Foundation\Http\FormRequest;

class CourseValidation extends FormRequest
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
                    'academic_y1' => ['required', 'numeric', new ValidAcademic($this->request->get('academic_y2'))],
                    'academic_y2' => 'required|numeric',
                    'semester' => 'required|min:1|max:8',
                    'name' => 'required|max:100|unique:courses',
                    'code' => 'required|max:10|unique:courses',
                    'description' => 'required|max:65535',
                    'department_id' => 'required|exists:departments,id',
                    'taught_by' => 'required|exists:users,id'
                ];
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'academic_y1' => ['required', 'numeric', new ValidAcademic($this->request->get('academic_y2'))],
                    'academic_y2' => 'required|numeric',
                    'semester' => 'required|min:1|max:8',
                    'name' => 'required|max:100|unique:courses,name,' . $this->route('course'),
                    'code' => 'required|max:10|unique:courses,code,' . $this->route('course'),
                    'description' => 'required|max:65535',
                    'department_id' => 'required|exists:departments,id',
                    'taught_by' => 'required|exists:users,id'
                ];
            }
            default:
                return [];
        }
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $validated = parent::validated();

        $validated['academic'] = $validated['academic_y1'] . '-' . $validated['academic_y2'];
        unset($validated['academic_y1']);
        unset($validated['academic_y2']);

        return $validated;
    }

}
