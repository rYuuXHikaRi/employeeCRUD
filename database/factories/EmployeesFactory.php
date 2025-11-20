<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'position' => $this->faker->randomElement(['Staff', 'Admin', 'Manager']),
            'salary' => $this->faker->numberBetween(3000000, 15000000),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'hired_at' => $this->faker->optional()->date(),
        ];
    }
}
