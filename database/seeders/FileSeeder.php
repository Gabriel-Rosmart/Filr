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
        for($i = 1; $i <= 100; $i++){
            DB::table('files')->insert([
                [
                    'date' => date('Y-m-d'),
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(25200, 43200)),
                ],
                [
                    'date' => date('Y-m-d'),
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(43600, 79200))
                ]
            ]);
        }
    }
}
