<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inserts = [
            [
                'name' => "UFJF",
                'city' => "Juiz de Fora"
            ],
            [
                'name' => "Estácio",
                'city' => "Juiz de Fora"
            ],
            [
                'name' => "Granbery",
                'city' => "Juiz de Fora"
            ],
            [
                'name' => "Granbery",
                'city' => "Juiz de Fora"
            ]
        ];
        
        School::insert($inserts);
    }
}
