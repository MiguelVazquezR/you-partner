<?php

use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\HomeworkController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::resource('/homeworks', HomeworkController::class)->except('show');
Route::get('/homeworks/on-collaboration', [HomeworkController::class, 'onCollaboration'])->name('homeworks.on-collaboration');
Route::get('/homeworks/finished', [HomeworkController::class, 'finished'])->name('homeworks.finished');

Route::resource('/collaborations', CollaborationController::class)->except('show');
Route::get('/collaborations/my-collaborations', [CollaborationController::class, 'myCollaborations'])->name('collaborations.my-collaborations');

Route::get('/privacy-policy', function (){
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');
Route::get('/terms-of-service', function (){
    return Inertia::render('TermsOfService');
})->name('terms-of-service');
Route::get('/contact', function (){
    return Inertia::render('Contact');
})->name('contact');

