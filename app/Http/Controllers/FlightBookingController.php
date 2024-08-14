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

        // Verificar se o usuário tem saldo suficiente
        if ($user->wallet_balance < $flight->price_usd * 100) {
            return redirect()->back()->with('error', 'Insufficient balance to book this flight. Please recharge your wallet.');
        }

        // Debitar o valor do saldo
        $user->wallet_balance -= $flight->price_usd * 100;
        $user->save();

        // Gerar um número de assento único
        $seatNumber = $this->generateSeatNumber($flight->id);

        // Registrar a reserva na tabela user_flights com o número de assento
        UserFlight::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
            'seat_number' => $seatNumber,
        ]);

        return redirect()->route('index')->with('success', 'Flight booked successfully!');
    }

    private function generateSeatNumber($flightId)
    {
        $letters = range('A', 'I'); // Letras de A a I
        $letter = $letters[array_rand($letters)]; // Escolhe uma letra aleatória
        $number = str_pad(rand(1, 50), 2, '0', STR_PAD_LEFT); // Número de 01 a 50
        $seatNumber = $letter . $number;

        // Verificar se o número de assento já está em uso
        while (UserFlight::where('flight_id', $flightId)->where('seat_number', $seatNumber)->exists()) {
            $number = str_pad(rand(1, 50), 2, '0', STR_PAD_LEFT); // Novo número
            $seatNumber = $letter . $number;
        }

        return $seatNumber;
    }
}
