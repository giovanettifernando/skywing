<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Flight;
use Illuminate\Support\Str;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        $companies = [
            'Azores Airlines',
            'TAP Airlines',
            'LATAM Airlines',
            'Qatar Airways',
            'Ryanair'
        ];

        return [
            'origin' => $this->faker->city,
            'destination' => $this->faker->city,
            'flight_date' => $this->faker->date,
            'departure_time' => $this->faker->time,
            'arrival_time' => $this->faker->time,
            'company_name' => $this->faker->randomElement($companies),
            'price_usd' => $this->faker->numberBetween(100, 1000),
            'is_active' => $this->faker->boolean,
            'slug' => Str::slug($this->faker->city . '-to-' . $this->faker->city . '-' . Str::random(10)),
        ];
    }

    public function active()
    {
        return $this->state([
            'is_active' => true,
        ]);
    }
}
