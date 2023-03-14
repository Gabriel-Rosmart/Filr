<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsValidDNI implements InvokableRule
{
    /**
     * Make sure the provided string is a valid DNI
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(preg_match("/^[0-9]{8}[a-zA-z]{1}$/", $value) == 0) $fail('The :attribute must be a valid DNI');
    }
}
