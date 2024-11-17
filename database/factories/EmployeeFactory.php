<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'birthdate' => fake()->date(),
            'sex' => fake()->randomElement(['male', 'female']),
            'city' => fake()->city(),
            'job'=> fake()->jobTitle(),
            'salary' => fake()->numberBetween(20000, 100000),
            'number' => fake()->phoneNumber(),
            'photo'=> "https://loremflickr.com/640/480/people",
            'email' => fake()->unique()->safeEmail()
        ];
    }
}
