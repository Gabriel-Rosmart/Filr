<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class DatesDontOverlap implements InvokableRule
{
    /**
     * Ensuring that dates in date_ranges don't overlap
     *
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(strtotime($value['start_date']) > strtotime($value['end_date']))
            $fail(trans('rules.date_order'));
    }

}
