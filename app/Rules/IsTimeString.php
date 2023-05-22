<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class IsTimeString implements InvokableRule
{
    /**
     * Make sure the provided array with strings are all 
     * valid time signatures
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
                $fail(trans('rules.time_format'));
            }
        }

    }
}
