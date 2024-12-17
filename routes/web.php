<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomepageController;

Route::get('/register', [UserController::class, 'showForm'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('user.store');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('/forgot-password', [UserController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');

Route::get('/verify-otp', [UserController::class, 'showOtpForm'])->name('verify.otp.form');
Route::post('/verify-otp', [UserController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/resend-otp', [UserController::class, 'resendOtp'])->name('resend.otp');

Route::get('/reset-password', [UserController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password.post');

Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
