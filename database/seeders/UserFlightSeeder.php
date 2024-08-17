<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Flight;
use App\Models\UserFlight;

class UserFlightSeeder extends Seeder
{
    public function run()
    {
        $flights = Flight::all();

        foreach ($flights as $flight) {
// Create 15 users for the flight
            $users = User::factory(15)->create();

            foreach ($users as $user) {
// Create UserFlight with a unique seat
                UserFlight::factory()->create([
                    'user_id' => $user->id,
                    'flight_id' => $flight->id,
                ]);
            }
        }
    }
}
