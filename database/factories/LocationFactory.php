<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => "Ponto - " . $this->faker->numberBetween(0, 100),
            'description' => $this->faker->text(50),
            'coordinates' => DB::raw("GEOMFROMTEXT('POINT(" . $this->faker->longitude() . " ". $this->faker->latitude() .")')"),
            'hour' => $this->faker->time('h:i:s'),
        ];
    }
}
