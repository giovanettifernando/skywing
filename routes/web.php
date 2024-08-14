<?php

use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController; //

// Rotas principais
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::post('/wallet/add', [WalletController::class, 'addMoney'])->name('wallet.add');
Route::post('/flights/{flight}/book', [FlightBookingController::class, 'book'])->name('flights.book');




// Rotas admin
Route::prefix('/admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        Route::resource('flights', \App\Http\Controllers\Admin\FlightsController::class);
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
    Route::get('/profile/user_flights/{slug}', [ProfileController::class, 'show'])->name('profile.user_flights.slug');







//     // Rotas de registro e login para Admin
// Route::get('/admin/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
// Route::post('/admin/register', [AdminRegisterController::class, 'register']);
// Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminLoginController::class, 'login']);

});

require __DIR__.'/auth.php';
