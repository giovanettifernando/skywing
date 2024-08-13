<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(private Flight $flight)
    {
    }


    public function index(Request $request): View
    {
        $flights = $this->flight->where('is_active', true)->orderBy('flight_date', 'desc')->paginate(10);
        $user = $request->user(); // Obtém o usuário logado

        return view('flights.index', [
            'flights' => $flights,
            'user' => $user, // Passa o usuário para a view
        ]);
    }


    public function show($slug)
    {
        $flight = $this->flight->where('slug', $slug)->firstOrFail();
        return view('flights.flight', compact('flight'));
    }
}
