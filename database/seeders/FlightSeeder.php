<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
// Create 10 flights
        Flight::factory(10)->create();

// Create 20 active flights
        Flight::factory(20)->active()->create();
    }
}
