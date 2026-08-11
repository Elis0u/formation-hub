<?php

namespace Database\Factories;

use App\Models\FormationSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FormationSession>
 */
class FormationSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startAt = fake()->dateTimeBetween('now', '+2 months');

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'start_at' => $startAt,
            'end_at' => (clone $startAt)->modify('+'.fake()->numberBetween(2, 8).' hours'),
            'location' => fake()->city(),
            'max_capacity' => fake()->numberBetween(5, 30),
            'trainer_id' => User::factory(),
        ];
    }
}
