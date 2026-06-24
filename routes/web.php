<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.auth');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
});

Route::middleware(['auth'])->group(function () {

    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard/surat/{id}/cetak', [SuratController::class, 'cetakPdf'])->name('dashboard.surat.cetak');

    // Rute Internal Aplikasi Dashboard Santri yang dilindungi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/anggota', [DashboardController::class, 'anggota'])->name('dashboard.anggota');

    // Rute Resource Surat Izin Santri milikmu
    Route::resource('dashboard/surat', SuratController::class)->names([
        'index'   => 'dashboard.surat.index',
        'create'  => 'dashboard.surat.create',
        'store'   => 'dashboard.surat.store',
        'edit'    => 'dashboard.surat.edit',
        'update'  => 'dashboard.surat.update',
        'destroy' => 'dashboard.surat.destroy',
    ]);
});


// Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
// Route::get('/dashboard/anggota',[DashboardController::class,'anggota'])->name('dashboard.anggota');
// // Route::get('/dashboard/surat', [DashboardController::class, 'semuaSurat'])->name('dashboard.surat');

// Route::resource('dashboard/surat', SuratController::class)->names([
//     'index'   => 'dashboard.surat.index',
//     'create'  => 'dashboard.surat.create',
//     'store'   => 'dashboard.surat.store',
//     'edit'    => 'dashboard.surat.edit',
//     'update'  => 'dashboard.surat.update',
//     'destroy' => 'dashboard.surat.destroy',
// ]);
