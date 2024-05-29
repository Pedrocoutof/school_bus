<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
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
            'phone' => $this->faker->phoneNumber(),
            'password' => bcrypt("12345678"),
            'zip_code' => $this->faker->postcode(),
            'public_place' => $this->faker->streetName(),
            'state' => $this->faker->countryCode(),
            'neighborhood' => $this->faker->streetSuffix(),
            'city' => $this->faker->city(),
            'number' => $this->faker->buildingNumber(),
        ];
    }
}
