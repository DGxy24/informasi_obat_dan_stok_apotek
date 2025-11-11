<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page (Guest only)
Route::get('/', function () {
    // Jika sudah login, redirect berdasarkan role
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('obat.index');
    }
    return view('welcome');
})->name('home');

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

// Logout Route (Auth only)
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== USER ROUTES ====================
Route::middleware(['auth', 'user'])->group(function () {
    // Obat Routes
    Route::get('/obat', [ObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/{id}', [ObatController::class, 'show'])->name('obat.show');
    
    // Lokasi Route
    Route::get('/lokasi', function () {
        return view('user.lokasi');
    })->name('lokasi');
    
    // About Route
    Route::get('/about', function () {
        return view('user.about');
    })->name('about');
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    
    // Admin Obat Management (CRUD)
    Route::get('/obat', function () {
        return view('admin.obat.index');
    })->name('obat.index');
    
    Route::get('/obat/create', function () {
        return view('admin.obat.create');
    })->name('obat.create');
    
    Route::get('/obat/{id}/edit', function ($id) {
        return view('admin.obat.edit', compact('id'));
    })->name('obat.edit');
    
    // Admin User Management
    Route::get('/users',[UserController::class,'index'])->name('user.index');
    
    // Admin Reports
    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');
});

// ==================== SHARED ROUTES (Auth only) ====================
Route::middleware('auth')->group(function () {
    // Dashboard - redirect berdasarkan role
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('obat.index');
    })->name('dashboard');
});