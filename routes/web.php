<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Livewire\Dashboard;
use App\Models\SalesCommission;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;




Route::get('/chart', function () {
    return view('chart');
});

Route::get('/api/chart-data', [ChartController::class, 'getData']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/clients', ClientController::class);
    Route::get('/sales', [SaleController::class, 'index']);
});


require __DIR__.'/auth.php';
