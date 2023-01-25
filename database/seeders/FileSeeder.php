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
        for($i = 1; $i <= 10; $i++){
            DB::table('files')->insert([
                [
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(25200, 43200)),
                ],
                [
                    'user_id' => $i,
                    'timestamp' => date('H:m:s', rand(43600, 79200))
                ]
            ]);
        }
    }
}
