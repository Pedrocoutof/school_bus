<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locationId = 1;
        Route::all()->each(function (Route $route) use (&$locationId) {
            for ($index = 0; $index < 4; $index++) {
                $route->locations()->attach($locationId, [
                    'order' => $index
                ]);
                $locationId++;
            }
        });
    }
}
