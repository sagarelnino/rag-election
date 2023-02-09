<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\UserController;

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

Route::get('/', [InitController::class, 'index']);

/**
 * Auth Routes
 */
Route::post('/register', [InitController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('/registration_status/{user_id}', [UserController::class, 'registrationStatus']);

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::middleware(['auth'])->group(function () {
    /**Admin Routes */
    Route::middleware(['admin'])->group(function () {
        Route::get('/voters', [UserController::class, 'voters']);
        Route::get('/approval', [UserController::class, 'approvals']);
        Route::get('/user/{user_id}', [UserController::class, 'getUser']);
        Route::post('/update_approval/{user_id}', [UserController::class, 'updateApproval']);
        Route::delete('/delete_user/{user_id}', [UserController::class, 'deleteUser']);
        Route::get('/election/create', [ElectionController::class, 'create']);
        Route::post('/election', [ElectionController::class, 'store']);
        Route::post('/election_activity', [ElectionController::class, 'updateActivity']);
        Route::post('/election_vote_show', [ElectionController::class, 'updateVoteShow']);
        Route::delete('/election', [ElectionController::class, 'destroy']);
        Route::get('/election/{id}/edit', [ElectionController::class, 'edit']);
        Route::patch('/election/{id}', [ElectionController::class, 'update']);
    });

    Route::middleware('is_active')->group(function () {
        Route::get('/elections', [ElectionController::class, 'index']);
        Route::get('/election/{id}', [ElectionController::class, 'show']);
        Route::post('/vote/{election_id}', [ElectionController::class, 'vote'])->middleware('is_voter');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    /**Password Change */
    Route::get('/password_change', [UserController::class, 'showChangePasswordForm'])->middleware('auth');
    Route::post('/password_change', [UserController::class, 'passwordChange'])->name('password_change')->middleware('auth');
});
