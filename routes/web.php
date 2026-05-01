<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

//HOMEPAGE
Route::get('/', [HomepageController::class, 'homepage']);

// AUTH
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/process', [AuthController::class, 'loginProcess']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register/process', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/my-profile', [ProfileController::class, 'myProfile']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});




// Route::get('/event-detail', [HomepageController::class, 'event-detail']);
// Route::get('/events', [HomepageController::class, 'events']);
// Route::get('/facilities', [HomepageController::class, 'facilities']);
// Route::get('/gallery', [HomepageController::class, 'gallery']);
// Route::get('/contact', [HomepageController::class, 'contact']);
// Route::get('/coaches', [HomepageController::class, 'coaches']);
// Route::get('/about-us', [HomepageController::class, 'aboutUs']);

?>
