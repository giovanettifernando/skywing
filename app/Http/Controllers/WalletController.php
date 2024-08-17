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

// Add the amount to the user's wallet
        $user->wallet_balance += $amount * 100;
        $user->save();
        return redirect()->back()->with('success', 'Balance successfully added!');
    }
}
