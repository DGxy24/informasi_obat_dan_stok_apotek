<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user', function () {
    return view('user.obat');
});
// Authentication Routes
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Logout Route (optional)
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
