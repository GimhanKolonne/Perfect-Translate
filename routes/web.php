<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TranslatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');

})->name('home');

Route::resource('translators', TranslatorController::class)
    ->middleware(['auth', 'verified']);

Route::get('/translator/profile/{id}', [TranslatorController::class, 'displayProfile'])->name('translators.display-profile');

Route::get('/client/profile/{id}', [ClientController::class, 'displayProfile'])->name('clients.display-profile');

Route::get('/display/projects', [ProjectController::class, 'displayProjects'])->name('projects.display-projects');

Route::get('/client/search', [ClientController::class, 'search'])->name('search');

Route::get('/translator/search', [TranslatorController::class, 'search'])->name('search');

Route::get('/project/search', [ProjectController::class, 'search'])->name('search');

Route::get('/project/filter', [ProjectController::class, 'filter'])->name('search');

Route::resource('projects', ProjectController::class)
    ->middleware(['auth', 'verified', 'client']);

Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'verified']);

Route::post('/translators/upload-certificate', [TranslatorController::class, 'uploadCertificate'])->name('translators.upload-certificate');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');
});
