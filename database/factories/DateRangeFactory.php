<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DateRange>
 */
class DateRangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'start_date' => fake()->dateTimeBetween('-2 months', '+2 days')->format('Y-m-d'),
            'end_date' => fake()->dateTimeBetween('+2 months', '+8 months')->format('Y-m-d')
        ];
    }
}
