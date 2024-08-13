<?php

// app/Http/Controllers/AdminLoginController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.admin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/flights');
        }

        return redirect()->back()->withErrors(['email' => 'Credenciais inválidas ou não é um administrador.']);
    }
}

