<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'), 
            'email' => $this->faker->unique()->safeEmail(),
            'birthdate' => $this->faker->date('Y-m-d', '2005-12-31'),
            'google_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
