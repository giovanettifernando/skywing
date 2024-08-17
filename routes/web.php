<?php

use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController; //

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::post('/wallet/add', [WalletController::class, 'addMoney'])->name('wallet.add');
Route::post('/flights/{flight}/book', [FlightBookingController::class, 'book'])->name('flights.book');

// Rotas admin
Route::prefix('/admin')
    ->middleware(['auth', '\App\Http\Middleware\AdminMiddleware::class'])
    ->name('admin.')
    ->group(function () {
        Route::resource('flights', \App\Http\Controllers\Admin\FlightsController::class);
        Route::get('/flights/{slug}', [FlightsController::class, 'show'])->name('flights.show');
    });


// Breeze
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/user_flights', [ProfileController::class, 'user_flights'])->name('profile.user_flights');
    Route::get('/profile/user_flights/{slug}', [ProfileController::class, 'show'])->name('profile.user_flights.boarding-pass');



});

require __DIR__.'/auth.php';
