<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Models\Peminjaman;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('customer', CustomerController::class)->parameters([
        'customer' => 'customer'
    ]);

    Route::resource('sales', SalesController::class)->parameters([
        'sales' => 'sales'
    ]);

    Route::resource('item', ItemController::class)->parameters([
        'item' => 'item'
    ]);

    Route::resource('user', UserController::class)->parameters([
        'user' => 'user'    
    ]);

    Route::resource('level', LevelController::class)->parameters([
        'level' => 'level'
    ]);

    Route::resource('transaction', TransactionController::class)->parameters([
        'transaction' => 'transaction'
    ]);
});

require __DIR__.'/auth.php';
