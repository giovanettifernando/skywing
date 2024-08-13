<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        // Criar 10 voos
        Flight::factory(10)->create();

        // Criar 20 voos ativos
        Flight::factory(20)->active()->create();
    }
}
