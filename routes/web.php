<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;



Route::post('/register-user', [UserController::class, 'storeUser'])->name('register.user');
Route::post('/register-company', [UserController::class, 'storeCompany'])->name('register.company');

Route::get('/', function () {
    return view('welcome');
}) ->name('welcome');

Route::get('/registration', [
    RegistrationController::class, 'showRegistrationForm'
])->name('registration');
Route::get('/registration-company', function () {
    return view('registration-company');
})->name('registration-company');
Route::get('/registration-user', function () {
    return view('registration-user');
})->name('registration-user');
Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name( 'home');
});
Route::get('/sell', function () {
    return view('sell');
})->name('sell');

Route::get('/email/verify/{id}/{token}', [UserController::class, 'verifyEmail'])->name('verification.verify');
Route::get('/email/verify', [UserController::class, 'showVerificationNotice'])->name('verification.notice');
Route::get('/email/resend', [UserController::class, 'resendVerificationEmail'])->name('verification.resend');

Route::get('/forgotten-password', [PasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgotten-password', [PasswordController::class, 'sendPasswordResetLink'])->name('password.email');
Route::get('/password-reset/{email}/{token}', [PasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/password-reset', [PasswordController::class, 'resetPassword'])->name('password.update');


Route::post('/upload', [UploadController::class, 'store'])->name('upload');
