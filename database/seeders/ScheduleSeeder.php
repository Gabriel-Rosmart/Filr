<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
            'sunday'
        ];

        $data = [];

        for($i = 1; $i <= 100; $i++){
            foreach($days as $day){
                $data[] = [
                    'date_range_id' => $i,
                    'day' => $day,
                    'starts_at' => date('H:m:s', rand(0, 43200)),
                    'ends_at' => date('H:m:s', rand(43300, 86399))
                ];
            }
        }

        DB::table('schedules')->insert($data);
    }
}
