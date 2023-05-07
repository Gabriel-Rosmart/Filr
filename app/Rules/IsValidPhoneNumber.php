<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsValidPhoneNumber implements InvokableRule
{
    /**
     * Make sure the provided string is a valid phone number
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(preg_match("/^[0-9]{9}$/", $value) == 0) $fail('The :attribute must be a valid phone number');
    }
}
