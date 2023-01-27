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
            'requested_at' => fake()->date(),
            'status' => ['pending', 'accepted', 'denied'][array_rand(['pending', 'accepted', 'denied'])]
        ];
    }
}
