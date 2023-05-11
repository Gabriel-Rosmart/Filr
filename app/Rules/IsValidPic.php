<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class IsValidPic implements InvokableRule
{
    /**
     * Make sure that the image that the user is uploading satisfies the expected parameters:
     * Just one file, must be jpg, png, jpeg or gif and size lower than 20MB.
     * Abort the process if any of the previous requirements isn't fulfilled.
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
            $fail(trans('rules.image_error'));
        } else if (count($value) != 1) {
            $fail(trans('rules.image_error'));
        } else if ($value[0]->extension() != 'png' & $value[0]->extension() != 'jpg' & $value[0]->extension() != 'jpeg' & $value[0]->extension() != 'gif') {
            $fail(trans('rules.image_format'));
        } else if ($value[0]->getSize() > 20000000) {
            $fail(trans('rules.image_size'));
        }
    }
}
