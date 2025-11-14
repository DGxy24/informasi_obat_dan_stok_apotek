<?php


use App\Http\Controllers\AdminObatController;
use App\Http\Controllers\AdminStockController;
use App\Http\Controllers\AdminSupplierController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin Obat Management (CRUD) - Using MedicineController
    Route::get('/obat', [AdminObatController::class, 'index'])->name('obat.index');
    Route::get('/obat/create', [AdminObatController::class, 'create'])->name('obat.create');
    Route::post('/obat', [AdminObatController::class, 'store'])->name('obat.store');
    Route::get('/obat/{id}', [AdminObatController::class, 'show'])->name('obat.show');
    Route::put('/obat/{id}', [AdminObatController::class, 'update'])->name('obat.update');
    Route::delete('/obat/{id}', [AdminObatController::class, 'destroy'])->name('obat.destroy');
    
        // Admin supplier Management (CRUD)
    Route::resource('supplier', AdminSupplierController::class);

        // Admin Stock Management (CRUD)
     // PENTING: Route custom harus SEBELUM route yang pakai parameter
    Route::post('stock/create', [AdminStockController::class, 'create'])->name('stock.create');
    Route::post('stock/add', [AdminStockController::class, 'add'])->name('stock.add');
    Route::post('stock/reduce', [AdminStockController::class, 'reduce'])->name('stock.reduce');
    
    // Route dengan parameter di akhir
    Route::get('stock', [AdminStockController::class, 'index'])->name('stock.index');
    Route::get('stock/{medicineId}', [AdminStockController::class, 'show'])->name('stock.show');

    // Admin User Management (CRUD)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
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