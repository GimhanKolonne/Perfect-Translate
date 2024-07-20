<?php

use App\Http\Controllers\TranslatorController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');

})->name('home');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
