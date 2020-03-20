<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAcademic implements Rule
{
    protected $academic_y2;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($academic_y2)
    {
        $this->academic_y2 = $academic_y2;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value + 1 != $this->academic_y2)
            return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'First year should be one year smaller than the second year.';
    }
}
