<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Displays the main view for common users
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $timetable = DB::table('schedules as s')

            ->select('day','starts_at','ends_at')
            ->join('date_ranges as ranges' , 's.date_range_id', '=', 'ranges.id')
            ->join('date_range_user as u_ranges', 'ranges.id', '=', 'u_ranges.id')
            ->join('users as u', 'u_ranges.user_id', '=', 'u.id')
            ->where('u.id', $user->id)
            ->get();

        return Inertia::render('User/Dashboard', ['user' => $user, 'timetable' => $timetable]);
    }
    /**
     * Displays user-associated warnings
     * @return \Illuminate\Http\Response
     */
    public function warnings()
    {


        return Inertia::render('User/Warnings');
    }
    /**
     * Displays permits and incidents associated to the user 
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        return Inertia::render('User/Stats');
    }
}
