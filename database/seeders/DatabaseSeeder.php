<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class
        ]);

        \App\Models\User::factory(100)->create();
        \App\Models\User::factory()->create([
            'email' => 'admin@gmail.com',
            'is_admin' => true,
            'active' => true
        ]);

        \App\Models\Permit::factory(50)->create();
        \App\Models\DateRange::factory(100)->create();

        $this->call([
            DateRangeUserSeeder::class,
            ScheduleSeeder::class,
            FileSeeder::class
        ]);

        \App\Models\Incidence::factory(30)->create();
    }
}
