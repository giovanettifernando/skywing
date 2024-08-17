<?php

namespace Database\Factories;

use App\Models\UserFlight;
use App\Models\User;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFlightFactory extends Factory
{
    protected $model = UserFlight::class;

    public function definition()
    {
        return [
            'seat_number' => $this->generateSeatNumber(),
            'user_id' => User::factory(),
            'flight_id' => Flight::factory(),
        ];
    }

    private function generateSeatNumber()
    {
        $seats = range('A', 'I');
        $numbers = range(1, 50);

        $takenSeats = UserFlight::pluck('seat_number')->toArray();

        do {
            $seat = $seats[array_rand($seats)] . str_pad($numbers[array_rand($numbers)], 2, '0', STR_PAD_LEFT);
        } while (in_array($seat, $takenSeats));

        return $seat;
    }
}

