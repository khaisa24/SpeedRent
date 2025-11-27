<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;

Route::get('/test-kategori-simple', function() {
    try {
        $controller = new App\Http\Controllers\KategoriController();
        return $controller->index();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Route utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // === PERBAIKAN: HANYA SATU ROUTE DASHBOARD YANG AUTO-REDIRECT ===
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
        Route::get('/users', function () {
            return view('admin.users');
        })->name('users');
        
        // Kategori routes
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan');
        Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');

        Route::get('/harga', [HargaController::class, 'index'])->name('harga');
        Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');
        Route::put('/harga/{id}', [HargaController::class, 'update'])->name('harga.update');
        Route::delete('/harga/{id}', [HargaController::class, 'destroy'])->name('harga.destroy');

        Route::get('/rental', [RentalController::class, 'index'])->name('rental');
        Route::post('/rental', [RentalController::class, 'store'])->name('rental.store');
        Route::put('/rental/{id}', [RentalController::class, 'update'])->name('rental.update');
        Route::delete('/rental/{id}', [RentalController::class, 'destroy'])->name('rental.destroy');
        Route::put('/rental/{id}/status', [RentalController::class, 'updateStatus'])->name('rental.updateStatus');

        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
        Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');
        Route::put('/pembayaran/{id}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
        Route::get('/pembayaran/{id}/bukti', [PembayaranController::class, 'showBukti'])->name('pembayaran.bukti');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Owner routes
    Route::prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'ownerDashboard'])->name('dashboard');
        
        // Tambahkan routes lain untuk owner
        Route::get('/kategori', [KategoriController::class, 'ownerIndex'])->name('kategori');
        Route::get('/kendaraan', [KendaraanController::class, 'ownerIndex'])->name('kendaraan');
        Route::get('/laporan', [LaporanController::class, 'ownerIndex'])->name('laporan');
    });

    // User/Customer routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');
        Route::get('/kendaraan', [KendaraanController::class, 'userIndex'])->name('kendaraan');
        Route::get('/rental', [RentalController::class, 'userIndex'])->name('rental');
        Route::get('/rental/history', [RentalController::class, 'userHistory'])->name('rental.history');
        Route::post('/rental', [RentalController::class, 'userStore'])->name('rental.store');
        Route::get('/pembayaran', [PembayaranController::class, 'userIndex'])->name('pembayaran');
        Route::post('/pembayaran', [PembayaranController::class, 'userStore'])->name('pembayaran.store');
    });
});