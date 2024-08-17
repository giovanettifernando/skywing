<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFlight;

class FlightBookingController extends Controller
{
    public function book(Flight $flight)
    {
        $user = Auth::user();


// Check if the user has sufficient balance
        if ($user->wallet_balance < $flight->price_usd * 100) {
            return redirect()->back()->with('error', 'Insufficient balance to book this flight. Please recharge your wallet.');
        }

// Debit the amount from the balance
        $user->wallet_balance -= $flight->price_usd * 100;
        $user->save();

// Generate a unique seat number
        $seatNumber = $this->generateSeatNumber($flight->id);

// Record the reservation in the user_flights table with the seat number
        UserFlight::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
            'seat_number' => $seatNumber,
        ]);

        return redirect()->route('index')->with('success', 'Flight booked successfully!');
    }

    private function generateSeatNumber($flightId)
    {
        $letters = range('A', 'I');
        $letter = $letters[array_rand($letters)];
        $number = str_pad(rand(1, 50), 2, '0', STR_PAD_LEFT);
        $seatNumber = $letter . $number;

// Check if the seat number is already in use
        while (UserFlight::where('flight_id', $flightId)->where('seat_number', $seatNumber)->exists()) {
            $number = str_pad(rand(1, 50), 2, '0', STR_PAD_LEFT);
            $seatNumber = $letter . $number;
        }

        return $seatNumber;
    }
}
