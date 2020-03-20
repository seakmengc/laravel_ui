<?php

namespace App\Http\Requests;

use App\Rules\ValidCrud;
use Illuminate\Foundation\Http\FormRequest;

class RoleValidation extends FormRequest
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
        $permissions = [];
        foreach ($this->request->all() as $key => $value) {
            if($key != 'name' && $key != 'description' && $key != '_method'
                && $key != '_token')
                $permissions[$key] = new ValidCrud;
        }

        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|unique:roles|max:50',
                    'description' => 'required|max:65535',
                ] + $permissions;
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|max:50|unique:roles,name,' . $this->route('role')->id,
                    'description' => 'required|max:65535',
                ] + $permissions;
            default:
                return [];
        }
    }

    public function validatedRoleData()
    {
        $validated = parent::validated();

        $validated['name'] = strtolower($validated['name']);

        return [
            'name' => $validated['name'],
            'description' => $validated['description']
        ];
    }

    public function validatedRolePermissions()
    {
        $validated = parent::validated();

        unset($validated['name']);
        unset($validated['description']);

        return $validated;
    }
}
