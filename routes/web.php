<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TranslatorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;


Route::get('/', function () {
    return view('dashboard');

})->name('home');

Route::get('/translator/profile/{id}', [TranslatorController::class, 'displayProfile'])->name('translators.display-profile');

Route::get('/client/profile/{id}', [ClientController::class, 'displayProfile'])->name('clients.display-profile');

Route::get('/translators/dashboard', [ProjectController::class, 'displayProjects'])->name('projects.display-projects');

Route::get('/display/projects', [ProjectController::class, 'dashboard'])->name('projects.find-work');


Route::get('/view/projects/{id}', [ProjectController::class, 'viewProjects'])->name('projects.view-projects');

Route::get('/applications/{id}', [ApplicationController::class, 'applyProject'])->name('applications.apply-projects');

Route::get('/client/search', [ClientController::class, 'search'])->name('search');

Route::get('/translator/search', [TranslatorController::class, 'search'])->name('search');

Route::get('/project/search', [ProjectController::class, 'search'])->name('search');

Route::get('/project/filter', [ProjectController::class, 'filter'])->name('search');

Route::get('/projects/filter', [ProjectController::class, 'projectFilter'])->name('projects.filter');

Route::get('/projects/sent-applications', [ProjectController::class, 'sentApplications'])->name('projects.sent-applications');
Route::get('/projects/accepted-applications', [ProjectController::class, 'acceptedApplications'])->name('projects.accepted-applications');
Route::get('/projects/completed-applications', [ProjectController::class, 'completedApplications'])->name('projects.completed-applications');

Route::resource('translators', TranslatorController::class)
    ->middleware(['auth', 'verified']);

Route::resource('projects', ProjectController::class)
    ->middleware(['auth', 'verified', 'client']);

Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'verified']);

Route::resource('applications', \App\Http\Controllers\ApplicationController::class)
    ->middleware(['auth', 'verified']);

Route::resource('portfolios', \App\Http\Controllers\PortfolioController::class)
    ->middleware(['auth', 'verified']);

Route::resource('reviews', \App\Http\Controllers\ReviewController::class)
    ->middleware(['auth', 'verified']);

Route::get('/projects/{project}/reviews/client', [ReviewController::class, 'createReview'])->name('reviews.create');
Route::get('/projects/{project}/reviews/translator', [ReviewController::class, 'createMethod'])->name('reviews.create.translator');


Route::post('/translators/upload-certificate', [TranslatorController::class, 'uploadCertificate'])->name('translators.upload-certificate');

Route::get('/projects/{project}/applications', [ApplicationController::class, 'showApplications'])->name('applications.index');

Route::post('/clients/upload-document', [ClientController::class, 'uploadDocument'])->name('clients.upload-document');

Route::post('/applications/{id}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
Route::post('/applications/{id}/decline', [ApplicationController::class, 'decline'])->name('applications.decline');

Route::get('projects/{projectId}/applications', [ApplicationController::class, 'showApplications'])->name('applications.index');

Route::patch('/projects/{project}/status', [ProjectController::class, 'updateStatus'])->name('projects.update-status');

Route::get('/portfolios/{id}', [PortfolioController::class, 'show']);

Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index']);

Route::get('/project/management', [ProjectController::class, 'projectManagement'])->name('projects.management');
Route::post('/projects/{project}/set-sprints', [ProjectController::class, 'setSprints'])->name('projects.setSprints');
Route::post('/sprints/{sprint}/update-progress', [ProjectController::class, 'updateSprintProgress'])->name('sprints.updateProgress');

Route::get('/sprints/{sprint}/edit', [ProjectController::class, 'editSprint'])->name('sprints.edit');
Route::post('/sprints/{sprint}/update', [ProjectController::class, 'updateSprint'])->name('sprints.update');

Route::get('/client/projects', [ClientController::class, 'projectManagement'])->name('client.projects.management');
Route::get('/client/sprints/{sprintId}/progress', [ClientController::class, 'viewSprintProgress'])->name('client.sprints.progress');

Route::post('/client/sprints/{sprintId}/feedback', [ClientController::class, 'submitFeedback'])->name('client.sprints.feedback');

Route::get('/chat/{projectId}', [ChatController::class, 'index'])
    ->name('chat.index')
    ->middleware(['auth', 'belongs.to.project']);

Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])
    ->name('chat.send')
    ->middleware('auth');

Route::get('/chat/{projectId}/messages', [ChatController::class, 'fetchMessages'])
    ->name('chat.fetch')
    ->middleware(['auth', 'belongs.to.project']);

Route::post('/chat/{projectId}/upload', [ChatController::class, 'uploadFile'])
    ->name('chat.upload')
    ->middleware(['auth', 'belongs.to.project']);

Route::get('/chat/{projectId}/files', [ChatController::class, 'getProjectFiles'])
    ->name('chat.files')
    ->middleware(['auth', 'belongs.to.project']);

Route::delete('/chat/files/{fileId}', [ChatController::class, 'deleteFile'])
    ->name('chat.deleteFile')
    ->middleware('auth');

Route::patch('/projects/{project}/complete', [ProjectController::class, 'completeProject'])->name('client.projects.complete');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');
});

