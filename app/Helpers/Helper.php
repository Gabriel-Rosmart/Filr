<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\DateRange;
use Illuminate\Support\Facades\DB;

class Helper {
    public static function saveUserCompleteRecord($validated, $fakepw){

        $validated['schedules'] = weedOut($validated['schedules']);
    
        DB::transaction(function() use ($validated, $fakepw) {
            $user = User::create([
                'name' => $validated['name'],
                'dni' => $validated['dni'],
                'email' => $validated['email'],
                'phone' => $validated['telephone'],
                'role_id' => 1,
                'password' => $fakepw
            ]);
    
            $date = DateRange::create([
                'start_date' => $validated['dates']['start'],
                'end_date' => $validated['dates']['end']
            ]);
    
            DB::table('date_range_user')->insert([
                'user_id' => $user->id,
                'date_range_id' => $date->id
            ]);
    
            foreach($validated['schedules'] as $day => $times){
                if(count($times) < 4 && count($times) > 0){
                    Schedule::insert([
                        'date_range_id' => $date->id,
                        'day' => $day,
                        'starts_at' => $times[0],
                        'ends_at' => $times[1]
                    ]);
                }
                if(count($times) == 4){
                    Schedule::insert([
                        'date_range_id' => $date->id,
                        'day' => $day,
                        'starts_at' => $times[2],
                        'ends_at' => $times[3]
                    ]);
                }
            }
        });
    }
}


function weedOut(array $array){

    foreach($array as $day => $_){
        $array[$day] = array_filter($array[$day], fn($element) => !is_null($element));
    }

    return $array;
}