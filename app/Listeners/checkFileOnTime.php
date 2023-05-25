<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\File;
use App\Models\Incidence;
use App\Models\User;
use DateTime;

class checkFileOnTime
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $file = $event->file;

        $timetable = DB::table('schedules as s')
            ->select('day', 'starts_at', 'ends_at')
            ->join('date_ranges as ranges', 's.date_range_id', '=', 'ranges.id')
            ->join('date_range_user as u_ranges', 'ranges.id', '=', 'u_ranges.id')
            ->join('users as u', 'u_ranges.user_id', '=', 'u.id')
            ->where('u.id', $file['user_id'])
            ->where('ranges.start_date', '<=', DB::raw('curdate()'))
            ->where('ranges.end_date', '>=', DB::raw('curdate()'))
            ->where('s.day', '=', strtolower(date('l', strtotime($file['date']))))
            ->get();
        $today_files = File::where('user_id', $file['user_id'])
            ->where('date', DB::raw('curdate()'))
            ->get();

        if (count($timetable) > 0)
        {
            $start  = $timetable[0]->starts_at;
            $end    = $timetable[0]->ends_at;
            if (count($timetable) > 1)
            {
                $start2  = $timetable[1]->starts_at;
                $end2    = $timetable[1]->ends_at;
            }

            $start = new DateTime($start);
            $end = new DateTime($end);
            $time = new DateTime($file['timestamp']);

            //dd(date('Y-m-d || h:i:s', $start), date('Y-m-d || h:i:s', $end), date('Y-m-d || h:i:s', $time));

            if (count($today_files) == 1 || count($today_files) == 3)
            {
                if (count($today_files) == 3)
                {
                    if (isset($start2) && $start2 != null)
                        $start = $start2;
                    else
                        return;
                }

                if ($start != null && $time > $start && $start->diff($time)->format('%i') > 5)
                {
                    DB::table('incidences')->insert([
                        'user_id' => $file['user_id'],
                        'date' => date('Y-m-d'),
                        'subject' => 'late',
                        'minutes' => $start->diff($time)->format('%i'),
                    ]);
                }
            }

            if (count($today_files) == 2 || count($today_files) == 4)
            {
                if (count($today_files) == 4)
                {
                    if (isset($end2) && $end2 != null)
                        $end = $end2;
                    else
                        return;
                    $end = $end2;
                }

                if ($end != null && $time < $end && $end->diff($time)->format('%i') > 5)
                {
                    $hours = $end->diff($time, true)->format('%h');
                    $min = $end->diff($time, true)->format('%i');
                    $total = $hours * 60 + $min;
                    DB::table('incidences')->insert([
                        'user_id' => $file['user_id'],
                        'date' => date('Y-m-d'),
                        'subject' => 'early',
                        'minutes' => $total,
                    ]);
                }
            }
        }
    }
}
