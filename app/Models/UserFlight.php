<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFlight extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'seat_number',
        'booking_date',
        'amount',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userFlight) {
            $userFlight->seat_number = self::generateSeatNumber();
        });
    }

    private static function generateSeatNumber()
    {
        return rand(1, 100);
    }


    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
