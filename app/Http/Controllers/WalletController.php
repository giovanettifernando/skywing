<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function addMoney(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount');

        // Adicionar o valor à carteira do usuário
        $user->wallet_balance += $amount * 100; // Supondo que o valor seja enviado em dólares
        $user->save();

        return redirect()->back()->with('success', 'Saldo adicionado com sucesso!');
    }
}
