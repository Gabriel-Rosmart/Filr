<?php

namespace App\Rules;

use App\Models\DateRange;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;
use Psy\CodeCleaner\AssignThisVariablePass;

class RangesDontOverlap implements InvokableRule
{
    private int $userId;
    private $rangeId;
    public function __construct($userId, $rangeId)
    {
        $this->userId = $userId;
        $this->rangeId = $rangeId;
    }
    /**
     * Ensuring that dates in date danges 
     * don't overlap with the previous one
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {

        $range = DB::table('date_ranges', 'r')
            ->select('r.id', 'r.start_date', 'r.end_date')
            ->join('date_range_user as ru', 'ru.date_range_id','=','r.id')
            ->where('ru.user_id', $this->userId)
            ->orderBy('start_date', 'asc')
            ->get(); 

        if($this->rangeId != null){   
            for ($i = 0; $i < count($range); $i++) { 
                if($range[$i]->id == $this->rangeId){
                    if(isset($range[$i - 1]) && $value['start_date'] < $range[$i-1]->end_date){
                        $fail(trans('rules.date_start_invalid'));
                    } else if(isset($range[$i + 1]) && $value['end_date'] > $range[$i + 1]->start_date){
                        $fail(trans('rules.date_end_invalid'));
                    }
                }
            }
        } else{
            if($value['start_date'] < $range[sizeof($range) - 1]->end_date){
                $fail(trans('rules.date_start_invalid'));
            }
        }
        

    }

}
