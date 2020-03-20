<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Permission;

class ValidCrud implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param $values
     * @return bool
     */
    public function passes($attribute, $values)
    {
        try {
            foreach ($values as $value)
                Permission::findByName($value . ' ' . $attribute);
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute permissions are not valid.';
    }
}
