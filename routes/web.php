<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TranslatorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');

})->name('home');



Route::resource('translators', TranslatorController::class)
    ->middleware('auth');

Route::resource('clients', ClientController::class)
    ->middleware('auth');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
