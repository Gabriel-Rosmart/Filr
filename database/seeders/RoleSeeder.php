<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            [
                'id' => 1,
                'role_name' => 'teacher'
            ],
            [
                'id' => 2,
                'role_name' => 'nonteacher'
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
