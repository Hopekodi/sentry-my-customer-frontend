<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DoNotPutCountryCode implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arr = str_split(strval($value), 3);

        // return $arr[0] !== $arr[1];
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose your country from the dropdown and dont include it in your number';
    }
}
