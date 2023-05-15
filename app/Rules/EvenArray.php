<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class EvenArray implements InvokableRule
{
    /**
     * Make sure the array has an even number of non null values
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $nonNullElements = 0;
        $acceptedLengths = [0, 2, 4];

        foreach($value as $element){
            if(!is_null($element)) $nonNullElements++;
        }

        if(!in_array($nonNullElements, $acceptedLengths)) 
        $fail(trans('rules.schedule_length'));
    }
}
