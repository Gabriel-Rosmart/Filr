<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\Exception as CarbonException;
use Error;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PDOException;
use App\Events\fileDoneCorrectly;

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
        //* Create a log to show submitted data     
        Log::channel('daily')->info('INFO; Requested data = ' . $this->getSubmittedData($request->request));
        try {
            //* Check if requested data are the expected
            $this->checkData($request);
            Log::channel('daily')->info('INFO; Data format OK');

            //* Get date and hour
            $date = Carbon::parse($request->date)->format("Y-m-d");
            $time = Carbon::parse($request->time)->format("H:i:s");
            Log::channel('daily')->info("INFO; Date ($date) and Time ($time) OK");

            //* Check database status
            DB::connection()->getPdo();
            Log::channel('daily')->info('INFO; Data Base connection OK');

            //* Check if the user id exists. Get name if it does
            $user = User::select('name')
                ->where('id', $request->id)
                ->first();
            Log::channel('daily')->info('INFO; User with id ' . $request->id . ' found: ' . $user->name);

            DB::table('files')->insert([
                'user_id' => $request->id,
                'date' => $date,
                'timestamp' => $time
            ]);
            Log::channel('daily')->info('INFO; Clocked in succesfuly');

            //Event sender
            fileDoneCorrectly::dispatch([
                'user_id' => $request->id,
                'date' => $date,
                'timestamp' => $time
            ]);


            return "User " . $user->name . " clocked in succesfuly at $time on $date";
        
        } catch (\Error $err) {
            Log::channel('daily')->error(get_class($err) . "; " . $err->getMessage());
            return $err->getMessage();
        
        } catch (CarbonException $ex){
            Log::channel('daily')->error(get_class($ex) . "; date or time not valid");
            return "Error Clocking in; date or time not valid";
       
        } catch (PDOException $ex){
            Log::channel('daily')->critical(get_class($ex) . "; " . $ex->getMessage());
            return $ex->getMessage();
        
        } catch (ErrorException $ex){
            Log::channel('daily')->error(get_class($ex) . "; " . $ex->getMessage());
            return $ex->getMessage();
        }
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