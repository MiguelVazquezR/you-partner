<?php

use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorReportController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RateController;
use App\Http\Resources\UserResource;
use App\Models\User;
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

Route::resource('/homeworks', HomeworkController::class)->except('index', 'show');
Route::get('/homeworks/no-collaboration', [HomeworkController::class, 'noCollaboration'])->name('homeworks.no-collaboration');
Route::get('/homeworks/on-collaboration', [HomeworkController::class, 'onCollaboration'])->name('homeworks.on-collaboration');
Route::get('/homeworks/completed', [HomeworkController::class, 'completed'])->name('homeworks.completed');
Route::get('/homeworks/claims', [HomeworkController::class, 'claims'])->name('homeworks.claims');
Route::post('/homeworks/send-message', [HomeworkController::class, 'sendMessage'])->name('homeworks.send-message');
Route::post('/homeworks/delete-file', [HomeworkController::class, 'deleteFile'])->name('homeworks.delete-file');
Route::post('/homeworks/update-with-resources/{homework}', [HomeworkController::class, 'updateWithResources'])->name('homeworks.update-with-resources');

Route::resource('/collaborations', CollaborationController::class)->except('show');
Route::get('/collaborations/approve-pendent', [CollaborationController::class, 'approvePendent'])->name('collaborations.approve-pendent');
Route::get('/collaborations/in-process', [CollaborationController::class, 'inProcess'])->name('collaborations.in-process');
Route::get('/collaborations/completed', [CollaborationController::class, 'completed'])->name('collaborations.completed');
Route::get('/collaborations/claims', [CollaborationController::class, 'claims'])->name('collaborations.claims');
Route::post('/collaborations/read-collaboration', [CollaborationController::class, 'readCollaboration'])->name('collaborations.read-collaboration');
Route::post('/collaborations/update-p', [CollaborationController::class, 'updateP'])->name('collaborations.update-p');
Route::put('/collaborations/approve/{collaboration}', [CollaborationController::class, 'approve'])->name('collaborations.approve');
Route::put('/collaborations/release-payment/{collaboration}', [CollaborationController::class, 'releasePayment'])->name('collaborations.release-payment');
Route::get('collaboration/{collaboration}/payment', [CollaborationController::class, 'payment'])->middleware('auth')->name('payment');
Route::post('collaboration/payment-method-create', [CollaborationController::class, 'paymentMethodCreate'])->middleware('auth')->name('collaborations.payment-method.create');
Route::post('collaboration/store-bank-data', [CollaborationController::class, 'storeBankData'])->middleware('auth')->name('collaborations.store-bank-data');

Route::get('/ranking', [RankingController::class,'ranking'])->name('ranking.index');
Route::get('/ranking/awards', [RankingController::class,'awards'])->name('ranking.awards');
Route::get('/ranking/motivation', [RankingController::class,'motivation'])->name('ranking.motivation');
Route::get('/ranking/levels', [RankingController::class,'levels'])->name('ranking.levels');

Route::get('/admin/finances', [AdminController::class,'finances'])->name('admin.finances');
Route::get('/admin/configurations', [AdminController::class,'configurations'])->name('admin.configurations');
Route::get('/admin/claims', [AdminController::class,'claims'])->name('admin.claims');
Route::get('/admin/notifications', [AdminController::class,'notifications'])->name('admin.notifications');
Route::get('/admin/users', [AdminController::class,'users'])->name('admin.users');
Route::get('/admin/errors', [AdminController::class,'errors'])->name('admin.errors');

Route::resource('/claims', ClaimController::class)->except('show');

Route::get('/library', [LibraryController::class,'index'])->name('library.index');


Route::get('/profile/{user}', function ($user_id){
    $user_ = User::with('collaborations', 'homeworks')->find($user_id);
    $user_ = new UserResource($user_);
    // return $user;
    return Inertia::render('ProfileUser', ['user' => $user_]);
})->name('profile-view');

Route::get('/privacy-policy', function (){
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');
Route::get('/terms-of-service', function (){
    return Inertia::render('TermsOfService');
})->name('terms-of-service');
Route::get('/contact', function (){
    return Inertia::render('Contact');
})->name('contact');

Route::resource('chat', ChatController::class);
Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
Route::post('/chat/read-messages', [ChatController::class, 'readMessage'])->name('chat.read-message');

Route::resource('rates', RateController::class)->middleware('auth');

Route::resource('error-reports', ErrorReportController::class);
Route::put('error-reports/mark-as-read/{error}', [ErrorReportController::class, 'markAsRead'])->name('error-reports.mark-as-read');

Route::get('notifications/{user}', [NotificationController::class, 'all'])->middleware('auth')->name('notifications.all');
Route::post('notifications/{user}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');