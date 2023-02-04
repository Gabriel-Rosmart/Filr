<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for($days = 40; $days >= 1; $days--){
            $date = date('Y-m-d', strtotime("-$days days"));
            for($i = 1; $i <= 100; $i++){
                $data[] = [
                    'date' => $date,
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(25200, 43200)),
                ];
                $data[] = [
                    'date' => $date,
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(43600, 79200))
                ];
            }
        }

        for($i = 1; $i <= 100; $i++){
            $data[] = [
                'date' => date('Y-m-d'),
                'user_id' => $i,
                'timestamp' => date('H:m:s', rand(25200, 43200)),
            ];
            $data[] = [
                'date' => date('Y-m-d'),
                'user_id' => $i,
                'timestamp' => date('H:m:s', rand(43600, 79200))
            ];
        }

        DB::table('files')->insert($data);
    }
}
