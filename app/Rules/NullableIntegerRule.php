<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class DecimalFormatRule
 * @package App\Rules
 *
 */
class NullableIntegerRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (empty($value))
            return true;


        return is_numeric($value);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ":attribute must be a valid number";
    }
}
