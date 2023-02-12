<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsTimeString implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        foreach($value as $element){
            if(preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $element) == 0 && !is_null($element)){
                $fail('The :attribute must be a valid time string');
            }
        }

    }
}
