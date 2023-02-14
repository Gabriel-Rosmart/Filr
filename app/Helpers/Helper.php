<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\DateRange;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function saveUserCompleteRecord($validated, $fakepw)
    {

        $validated['schedules'] = weedOut($validated['schedules']);
    
        DB::transaction(function() use ($validated, $fakepw) {
            if(!$validated['substitute']['is']) saveFromScratch($validated, $fakepw);
            else saveFromUser($validated, $fakepw);
        });
    }
    public static function updateUserCompleteRecord($validated, $user)
    {

        $validated['schedules'] = weedOut($validated['schedules']);

        DB::transaction(function () use ($validated, $user) {
            $user->update([
                'name' => $validated['name'],
                'dni' => $validated['dni'],
                'email' => $validated['email'],
                'phone' => $validated['telephone'],
                'role_id' => 1,
            ]);
        });
    }
}

function saveFromScratch($validated, $fakepw){
    $user = User::create([
        'name' => $validated['name'],
        'dni' => $validated['dni'],
        'email' => $validated['email'],
        'phone' => $validated['telephone'],
        'role_id' => 1,
        'admin' => $validated['admin'],
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
}

function saveFromUser($validated, $fakepw){
    
    $user = User::create([
        'name' => $validated['name'],
        'dni' => $validated['dni'],
        'email' => $validated['email'],
        'phone' => $validated['telephone'],
        'role_id' => 1,
        'admin' => $validated['admin'],
        'password' => $fakepw
    ]);

    $employee = User::select('id')->where('name', $validated['substitute']['name'])->get()->first();
    $date_range = DB::table('date_range_user')->select('date_range_id')->where('user_id', $employee->id)->get()->last();
    $date_ranges = DateRange::select('id', 'start_date', 'end_date')->where('id', $date_range->date_range_id)->get()->first();
    $schedules = Schedule::select('day', 'starts_at', 'ends_at')->where('date_range_id', $date_ranges->id)->get();

    //dd($schedules);

    $date = DateRange::create([
        'start_date' => $date_ranges->start_date,
        'end_date' => $date_ranges->end_date
    ]);

    DB::table('date_range_user')->insert([
        'user_id' => $user->id,
        'date_range_id' => $date->id
    ]);

    foreach($schedules as $schedule){
        Schedule::insert([
            'date_range_id' => $date->id,
            'day' => $schedule->day,
            'starts_at' => $schedule->starts_at,
            'ends_at' => $schedule->ends_at,
        ]);
    }
    
}


function weedOut(array $array)
{

    foreach ($array as $day => $_) {
        $array[$day] = array_filter($array[$day], fn ($element) => !is_null($element));
    }

    return $array;
}
