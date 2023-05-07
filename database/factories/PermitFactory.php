<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permit>
 */
class PermitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => fake()->uuid(),
            'user_id' => fake()->numberBetween(1, 100),
            'permitType' => ['death','move','exam','prenat','fecAs','marriage','duties','particularBussines','unexpection'][array_rand(['death','move','exam','prenat','fecAs','marriage','duties','particularBussines','unexpection'])],
            'requested_at' => fake()->date(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'status' => ['pending', 'accepted', 'denied'][array_rand(['pending', 'accepted', 'denied'])]
        ];
    }
}
