<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
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

    // Rute CRUD Anggota Asrama Manual
    Route::get('/dashboard/anggota', [MemberController::class, 'index'])->name('dashboard.anggota');
    Route::get('/dashboard/anggota/create', [MemberController::class, 'create'])->name('dashboard.anggota.create');
    Route::post('/dashboard/anggota', [MemberController::class, 'store'])->name('dashboard.anggota.store');
    Route::get('/dashboard/anggota/{id}/edit', [MemberController::class, 'edit'])->name('dashboard.anggota.edit');
    Route::put('/dashboard/anggota/{id}', [MemberController::class, 'update'])->name('dashboard.anggota.update');
    Route::delete('/dashboard/anggota/{id}', [MemberController::class, 'destroy'])->name('dashboard.anggota.destroy');

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
