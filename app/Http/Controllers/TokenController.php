<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        //*Create a log to show submitted data     
        Log::channel('daily')->info('INFO; Requested data = ' . $this->getSubmittedData($request->request));
        try {
            //Check if requested data are the expected
            $this->checkData($request);
            Log::channel('daily')->info('INFO; Data OK');

        } catch (\Error $err) {
            Log::channel('daily')->error(get_class($err) . "; " . $err->getMessage());
            return $err->getMessage();
        }

/*
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
    
        //return "User " . $user->name . " clocked in succesfuly at $time on $date";
    }
    /**
     * Obtain a string formed by the requested date names and values
     * @param   Object  $data   Data Received
     * @return  String          Names and values
     */
    public function getSubmittedData($data){
        $submittedData = "";
        foreach ($data as $key => $value) {
            $submittedData .= " $key($value) ";
        }
        return $submittedData;
    }

    /**
     * Check if the requested data fulfills the expected
     * parameters
     * @param   Object  $data  Data received
     */
    public function checkData($data){
        if(!isset($data->id) || !isset($data->date) || !isset($data->time)){
            throw new Error("Submited data is not valid || Expected id(Number) date(Y-m-d) time(H:i:s) || Received " . $this->getSubmittedData($data->request));           
        }
    }
}