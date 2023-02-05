<?php

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
    });

    Route::get('/elections', [ElectionController::class, 'index'])->middleware('is_active');
    Route::get('/election/{id}', [ElectionController::class, 'show'])->middleware('is_active');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    /**Password Change */
    Route::get('/password_change', [UserController::class, 'showChangePasswordForm'])->middleware('auth');
    Route::post('/password_change', [UserController::class, 'passwordChange'])->name('password_change')->middleware('auth');
});
