<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class TimeDoNotOverlap implements InvokableRule
{
    /**
     * Make sure that the provided array with times
     * do not overlap between each other and they
     * have a correct order
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        
        for($i = 1; $i < 4; $i++) {
            
            if(!is_null($value[$i]) && !is_null($value[$i - 1])){
                if(strtotime($value[$i]) < strtotime($value[$i - 1]))
                $fail('The :attribute does not have a correct order');
            }
            
        }
    }
}
