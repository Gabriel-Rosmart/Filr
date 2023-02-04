<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateRangeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        
        for($i = 1; $i <= 100; $i++){
            $data[] = [
                'user_id' => $i,
                'date_range_id' => $i
            ];
        }

        DB::table('date_range_user')->insert($data);
    }
}
