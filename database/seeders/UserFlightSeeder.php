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
            // Cria 15 usuários para o voo
            $users = User::factory(15)->create();

            foreach ($users as $user) {
                // Cria UserFlight com assento único
                UserFlight::factory()->create([
                    'user_id' => $user->id,
                    'flight_id' => $flight->id,
                ]);
            }
        }
    }
}
