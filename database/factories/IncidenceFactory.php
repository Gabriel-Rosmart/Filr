<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incidence>
 */
class IncidenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 100),
            'date' => fake()->dateTimeBetween('-1 month', '-1 day')->format('Y-m-d'),
            'subject' => ['early', 'late', 'absent'][array_rand(['early', 'late', 'absent'])],
            'minutes' => fake()->numberBetween(1, 30)
        ];
    }
}
