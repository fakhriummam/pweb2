<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('/dashboard/anggota',[DashboardController::class,'anggota'])->name('dashboard.anggota');
Route::get('/dashboard/surat', [DashboardController::class, 'semuaSurat'])->name('dashboard.surat');
