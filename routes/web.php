<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('guest.index');
});


Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'action'])->name('login-action');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout-action');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
