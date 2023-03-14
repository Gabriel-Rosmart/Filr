<?php

namespace App\Http\Controllers;

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
        $user_id = request()->input('token');

        // * Get date and hour
        $now = Carbon::now();
        $now->setTimezone("GMT+1");
        $date = $now->format("Y-m-d");
        $time = $now->format("H:i:s");

        // * Insert record on database
        DB::table('files')->insert([
            'user_id' => $user_id,
            'date' => $date,
            'timestamp' => $time
        ]);

        return "Clock in succesfuly";
    }
}