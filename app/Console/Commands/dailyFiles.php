<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class dailyFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Defiles all undefiled files from the day and check for absences';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = DB::table('users as u')
            ->select('u.id')
            ->join('date_range_user as u_ranges', 'u.id', '=', 'u_ranges.user_id')
            ->join('date_ranges as ranges', 'u_ranges.date_range_id', '=', 'ranges.id')
            ->where('ranges.start_date', '<=', DB::raw('curdate()'))
            ->where('ranges.end_date', '>=', DB::raw('curdate()'))
            ->get();

        foreach ($users as $user)
        {
            $files = DB::table('files')
                ->select('id', 'date', 'timestamp')
                ->where('user_id', $user->id)
                ->where('date', DB::raw('curdate()'))
                ->get();

            $timetable = DB::table('schedules as s')
                ->select('day', 'starts_at', 'ends_at')
                ->join('date_ranges as ranges', 's.date_range_id', '=', 'ranges.id')
                ->join('date_range_user as u_ranges', 'ranges.id', '=', 'u_ranges.id')
                ->join('users as u', 'u_ranges.user_id', '=', 'u.id')
                ->where('u.id', $user->id)
                ->where('ranges.start_date', '<=', DB::raw('curdate()'))
                ->where('ranges.end_date', '>=', DB::raw('curdate()'))
                ->where('s.day', '=', strtolower(date('l')))
                ->get();

            if (count($files) % 2 != 0)
            {
                DB::table('files')->insert([
                    'user_id' => $user->id,
                    'date' => date('Y-m-d'),
                    'timestamp' => date('H:i:s'),
                ]);
            }
            else if ((count($timetable) > 0 && count($files) == 0)
                    || (count($timetable) > 1 && count($files) == 2))
            {
                DB::table('incidences')->insert([
                    'user_id' => $user->id,
                    'date' => date('Y-m-d'),
                    'subject' => 'absent',
                    'minutes' => '0'
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
