<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ConfirmPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// guest
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');                                            // postman
    Route::post('register', [RegisterController::class, 'register'])->name('register.store');                          // postman
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.forgot');   // postman
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');                  // postman
});

// auth
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('user', [LoginController::class, 'user'])->name('user');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');                                         // postman

    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm'])->name('password.confirm');          // postman

    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend')                // postman
        ->middleware(['throttle:6,1']);
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])                                         // postman
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
