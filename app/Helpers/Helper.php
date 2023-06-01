<?php

namespace App\Helpers;

use App\Models\Role;
use App\Models\User;
use App\Models\Schedule;
use App\Models\DateRange;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class Helper
{
    /**
     * Process the registration of a user
     *
     * @return void
     */

    public static function saveUserCompleteRecord($validated, $fakepw)
    {

        $validated['schedules'] = weedOut($validated['schedules']);

        DB::transaction(function () use ($validated, $fakepw) {
            if (!$validated['substitute']['is'])
                saveFromScratch($validated, $fakepw);
            else
                saveFromUser($validated, $fakepw);
        });
    }

    /**
     * Update User data
     *
     * @return void
     */
    public static function updateUserCompleteRecord($validated, $user)
    {
        $validated['schedules'] = weedOut($validated['schedules']);
        DB::transaction(function () use ($validated, $user) {
            $user->update([
                'name' => $validated['name'],
                'dni' => $validated['dni'],
                'email' => $validated['email'],
                'phone' => $validated['telephone'],
            ]);
            DB::table('schedules')->where('date_range_id', $validated['schedules_id'])->delete();
            foreach ($validated['schedules'] as $key => $value) {
                if (isset($value[0]) && isset($value[1])) {
                    DB::table('schedules')->insert([
                        'date_range_id' => $validated['schedules_id'],
                        'day' => $key,
                        'starts_at' => $value[0],
                        'ends_at' => $value[1]
                    ]);
                }
                if (isset($value[2]) && isset($value[3])) {
                    DB::table('schedules')->insert([
                        'date_range_id' => $validated['schedules_id'],
                        'day' => $key,
                        'starts_at' => $value[2],
                        'ends_at' => $value[3]
                    ]);
                }
            }
        });
    }

    public static function updateUserDates($validated, $user){

    }
}

/**
 * Save a user from scratch
 *
 * @return void
 */
function saveFromScratch($validated, $fakepw)
{

    $role = Role::select('id', 'role_name')->where('role_name', $validated['role'])->get()->first();

    $user = User::create([
        'name' => $validated['name'],
        'dni' => $validated['dni'],
        'email' => $validated['email'],
        'phone' => $validated['telephone'],
        'role_id' => $role->id,
        'active' => determineIfUserShouldBeActive($validated['dates']['start'], $validated['dates']['end']),
        'is_admin' => $validated['admin'],
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

    foreach ($validated['schedules'] as $day => $times) {


        if (count($times) <= 4 && count($times) > 0) {
            Schedule::insert([
                'date_range_id' => $date->id,
                'day' => $day,
                'starts_at' => $times[0],
                'ends_at' => $times[1]
            ]);
        }
        if (count($times) == 4) {
            Schedule::insert([
                'date_range_id' => $date->id,
                'day' => $day,
                'starts_at' => $times[2],
                'ends_at' => $times[3]
            ]);
        }
    }
}

/**
 * Save a user taking the values of another existing user
 *
 * @return void
 */

function saveFromUser($validated, $fakepw)
{


    $employee = User::select('id', 'role_id')->where('name', $validated['substitute']['name'])->get()->first();
    $date_range = DB::table('date_range_user')->select('date_range_id')->where('user_id', $employee->id)->get()->last();
    $date_ranges = DateRange::select('id', 'start_date', 'end_date')->where('id', $date_range->date_range_id)->get()->first();
    $schedules = Schedule::select('day', 'starts_at', 'ends_at')->where('date_range_id', $date_ranges->id)->get();


    $user = User::create([
        'name' => $validated['name'],
        'dni' => $validated['dni'],
        'email' => $validated['email'],
        'phone' => $validated['telephone'],
        'role_id' => $employee->role_id,
        'active' => determineIfUserShouldBeActive($date_ranges->start_date, $date_ranges->end_date),
        'is_admin' => $validated['admin'],
        'password' => $fakepw
    ]);

    $date = DateRange::create([
        'start_date' => $date_ranges->start_date,
        'end_date' => $date_ranges->end_date
    ]);

    DB::table('date_range_user')->insert([
        'user_id' => $user->id,
        'date_range_id' => $date->id
    ]);

    foreach ($schedules as $schedule) {
        Schedule::insert([
            'date_range_id' => $date->id,
            'day' => $schedule->day,
            'starts_at' => $schedule->starts_at,
            'ends_at' => $schedule->ends_at,
        ]);
    }
}

/**
 * Remove all null values of array
 *
 * @return array
 */

function weedOut(array $array)
{

    foreach ($array as $day => $_) {
        $array[$day] = array_values(array_filter($array[$day], fn ($element) => !is_null($element)));
    }

    return $array;
}

/**
 * Determine if a user should be active based on the current data
 *
 * @return bool
 */
function determineIfUserShouldBeActive($startDate, $endDate)
{
    return \Carbon\Carbon::now()->between($startDate, $endDate);
}
