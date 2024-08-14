<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\UserFlight;
use App\Models\Flight;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */




public function show($slug)
{

    $flight = Flight::where('slug', $slug)->firstOrFail();
    $userFlight = UserFlight::where('flight_id', $flight->id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

    return view('profile.boarding-pass', [
        'flight' => $flight,
        'userFlight' => $userFlight
    ]);
}




    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function user_flights(Request $request): View
    {
        $userFlights = UserFlight::with('flight')
            ->where('user_id', $request->user()->id)
            ->paginate(10);

        return view('profile.user_flights', [
            'userFlights' => $userFlights,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
