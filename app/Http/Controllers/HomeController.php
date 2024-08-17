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
        $user = $request->user(); // Get the logged-in user

        return view('flights.index', [
            'flights' => $flights,
            'user' => $user, // Pass the user to the view

        ]);
    }
}
