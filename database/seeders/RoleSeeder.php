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
        DB::table('roles')->insert([
            'id' => 1,
            'role_name' => 'Profesor',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'role_name' => 'Administrativo',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'role_name' => 'Limpieza',
        ]);
    }
}
