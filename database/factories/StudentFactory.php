<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'),
            'neighborhood' => $this->faker->streetSuffix(),
            'city' => $this->faker->city(),
            'number' => $this->faker->buildingNumber(),
            'phone' => $this->faker->phoneNumber(),
            'public_place' => $this->faker->streetName(),
            'state' => '',
            'zip_code' => $this->faker->postcode(),
            'complement' => $this->faker->text(50),
            'school_id' => $this->faker->numberBetween(1, School::count()),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
