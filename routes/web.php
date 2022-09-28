<?php

use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\RankingController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::resource('/homeworks', HomeworkController::class)->except('show');
Route::get('/homeworks/no-collaboration', [HomeworkController::class, 'noCollaboration'])->name('homeworks.no-collaboration');
Route::get('/homeworks/on-collaboration', [HomeworkController::class, 'onCollaboration'])->name('homeworks.on-collaboration');
Route::get('/homeworks/finished', [HomeworkController::class, 'finished'])->name('homeworks.finished');
Route::post('/homeworks/send-message', [HomeworkController::class, 'sendMessage'])->name('homeworks.send-message');

Route::resource('/collaborations', CollaborationController::class)->except('show');
Route::get('/collaborations/my-collaborations', [CollaborationController::class, 'myCollaborations'])->name('collaborations.my-collaborations');

Route::get('/ranking', [RankingController::class,'ranking'])->name('ranking.index');
Route::get('/ranking/awards', [RankingController::class,'awards'])->name('ranking.awards');
Route::get('/ranking/motivation', [RankingController::class,'motivation'])->name('ranking.motivation');
Route::get('/ranking/levels', [RankingController::class,'levels'])->name('ranking.levels');

Route::get('/admin/finances', [AdminController::class,'finances'])->name('admin.finances');
Route::get('/admin/configurations', [AdminController::class,'configurations'])->name('admin.configurations');
Route::get('/admin/claims', [AdminController::class,'claims'])->name('admin.claims');
Route::get('/admin/notifications', [AdminController::class,'notifications'])->name('admin.notifications');
Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users');


Route::get('/library', [LibraryController::class,'index'])->name('library.index');

Route::get('/privacy-policy', function (){
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');
Route::get('/terms-of-service', function (){
    return Inertia::render('TermsOfService');
})->name('terms-of-service');
Route::get('/contact', function (){
    return Inertia::render('Contact');
})->name('contact');

