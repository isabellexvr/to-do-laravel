<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::get('/sign-up', [AuthController::class, 'showSignUpForm'])->name('sign-up');
Route::post('/sign-up', [AuthController::class, 'processSignUp'])->name('process-sign-up');

Route::get('/sign-in', [AuthController::class, 'showSignInForm'])->name('sign-in');
Route::post('/sign-in', [AuthController::class, 'processSignIn'])->name('process-sign-in');