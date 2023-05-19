<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    /**
     * Handle a employee file in saving it
     * to the database
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //$user_id = request()->input('token');

        // * Get date and hour
        $date = Carbon::parse($request->date)->format("Y-m-d");
        $time = Carbon::parse($request->time)->format("H:i:s");

        // * Get user name
        $user = User::select('name')
            ->where('id', $request->id)
            ->first();

        // * Insert record on database
        /*DB::table('files')->insert([
            'user_id' => $user_id,
            'date' => $date,
            'timestamp' => $time
        ]);*/
    
        return "User " . $user->name . " clocked in succesfuly at $time on $date";
    }
}