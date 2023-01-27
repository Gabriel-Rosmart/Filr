<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_range_id' => fake()->numberBetween(1, 5),
            'day' => strtolower(fake()->dayOfWeek()),
            'starts_at' => date('H:m:s', rand(0, 43200)),
            'ends_at' => date('H:m:s', rand(43300, 86399))
        ];
    }
}
