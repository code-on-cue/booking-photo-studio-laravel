<?php

use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\HariIniController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('home');
Route::post('/contact', [AppController::class, 'contact'])->name('guest.contact');


Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'action'])->name('login-action');
Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/register', [AuthController::class, 'registerAction'])->name('register-action');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout-action');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

Route::middleware('auth')->group(function () {
  Route::get('/booking/{type}/create', [AppController::class, 'transaction'])->name('guest.transaction');
  Route::get('/booking/booked', [AppController::class, 'booked'])->name('jadwal.booked');
  Route::get('/booking/{transaction}/payment', [AppController::class, 'transactionDetail'])->name('jadwal.payment');
  Route::post('/booking', [AppController::class, 'transactionStore'])->name('jadwal.store');
  Route::get('/booking/histories', [AppController::class, 'transactionHistories'])->name('booking.history');


  Route::middleware('admin')->group(function () {
    Route::resource('type', TypeController::class);

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/today', [HariIniController::class, 'index'])->name('transaction.hari-ini');
    Route::post('transaction/{transaction}/acc', [TransactionController::class, 'acc'])->name('transaction.acc');
    Route::post('transaction/{transaction}/reject', [TransactionController::class, 'reject'])->name('transaction.reject');
    Route::get('transaction/{transaction}/tandai-selesai', [TransactionController::class, 'tandaiSelesai'])->name('transaction.tandai-selesai');
    Route::post('transaction/{transaction}/tandai-selesai', [TransactionController::class, 'tandaiSelesaiAction'])->name('transaction.tandai-selesai.action');

    Route::get('/config', [ConfigController::class, 'index'])->name('config.index');
    Route::put('/config', [ConfigController::class, 'update'])->name('config.update');

    Route::get('/box', [BoxController::class, 'index'])->name('box.index');
  });
});
