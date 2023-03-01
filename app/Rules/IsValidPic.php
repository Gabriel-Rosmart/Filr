<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class IsValidPic implements InvokableRule
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

        //dd($value[0]->getSize());
        if (!is_array($value)) {
            $fail('Unexpected error');
        } else if (count($value) != 1) {
            $fail('Unexpected number of files');
        } else if ($value[0]->extension() != 'png' & $value[0]->extension() != 'jpg' & $value[0]->extension() != 'jpeg' & $value[0]->extension() != 'gif') {
            $fail('File must be type gif, png, jpg or jpeg');
        } else if ($value[0]->getSize() > 20000000) {
            $fail('File is too big');
        }
    }
}
