<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/clients', ClientController::class);

    Route::get('/chart', function(){

       return OpenAI::completions()->create([
           'model' => 'gpt-3.5-turbo-instruct',
           'prompt' => 'Me dê uma controller resource no padrão laravel',
           'max_tokens' => 1500
       ])->choices[0]->text;
    });

});


require __DIR__.'/auth.php';
