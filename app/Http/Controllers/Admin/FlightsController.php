<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Str;
use App\Http\Requests\FlightRequest;
use App\Models\User;

class FlightsController extends Controller
{
    private Flight $flight;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }


    public function index()
    {
        $flights = $this->flight->orderBy('flight_date', 'desc')->paginate(10);
        return view('admin.flights.index', compact('flights'));
    }

    public function create(User $user)//User $user
    {
        // $users = $user->all(['id', 'name']);
        return view('admin.flights.create');
        // compact('users'));//, compact('users)
    }

    public function store(FlightRequest $request)
    {
        $uniqueId = Str::random(10);
        $slug = Str::slug("{$request->origin}-to-{$request->destination}-{$uniqueId}");

        $data = $request->all();
        $data['slug'] = $slug;


        $this->flight->create($data);

        return redirect()->route('admin.flights.index');
    }

    public function edit($flight)
    {
        $flight = $this->flight->findOrFail($flight);
        return view('admin.flights.edit', compact('flight'));
    }

    public function update($flight, FlightRequest $request)
    {
        $flight = $this->flight->findOrFail($flight);
        $flight->update($request->validated());

        return redirect()->route('admin.flights.index', $flight->id);
    }

    public function destroy($flight)
    {
        $flight = $this->flight->findOrFail($flight);
        $flight->delete();

        return redirect()->route('admin.flights.index');
    }
}
