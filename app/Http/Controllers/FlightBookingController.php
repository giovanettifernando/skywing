<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;

class FlightBookingController extends Controller
{
    public function book(Flight $flight)
    {
        $user = Auth::user();

        // Verificar se o usuário tem saldo suficiente
        if ($user->wallet_balance < $flight->price_usd * 100) {
            return redirect()->back()->with('error', 'Saldo insuficiente para reservar este voo.');
        }

        // Debitar o valor do saldo
        $user->wallet_balance -= $flight->price_usd * 100;
        $user->save();

        // Registrar a reserva na tabela user_flights
        $user->flights()->attach($flight->id);

        return redirect()->route('index')->with('success', 'Voo reservado com sucesso!');
    }
}
