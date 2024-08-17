<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserFlight extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_id',
        'seat_number',
        'booking_date',
        'amount',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userFlight) {
            $userFlight->seat_number = self::generateSeatNumber($userFlight->flight_id);
        });
    }

    private static function generateSeatNumber($flightId)
    {
        $seats = range('A', 'I');
        $numbers = range(1, 50);

        $takenSeats = self::where('flight_id', $flightId)->pluck('seat_number')->toArray();

        // Gera um número de assento único
        do {
            $seat = $seats[array_rand($seats)] . str_pad($numbers[array_rand($numbers)], 2, '0', STR_PAD_LEFT);
        } while (in_array($seat, $takenSeats));

        return $seat;

        //unique seats
        do {
            $seat = $seats[array_rand($seats)] . str_pad($numbers[array_rand($numbers)], 2, '0', STR_PAD_LEFT);
        } while (in_array($seat, $takenSeats));

        return $seat;
    }
}
