<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'family_id' => 0,
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'registration_code' => rand(1000000, 9999999),
        ];
    }
}
