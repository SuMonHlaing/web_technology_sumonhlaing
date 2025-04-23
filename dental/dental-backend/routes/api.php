<?php

use App\Http\Controllers\Api\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Api\UserAuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// user register api
Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login', [UserAuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserAuthController::class, 'profile']);
    Route::post('/logout', [UserAuthController::class, 'logout']);

    Route::post('/appointments', [FrontendController::class, 'appointment']);
    Route::get('/appointments/list', [FrontendController::class, 'appointmentList']);
});

// API Routes for Doctors
Route::get('/doctors', [FrontendController::class, 'doctors']);
Route::get('/doctors/{id}', [FrontendController::class, 'showDoctor']);
Route::get('/popular/doctors', [FrontendController::class, 'popularDoctors']);

Route::get('/services', [FrontendController::class, 'services']);
Route::get('/services/{id}', [FrontendController::class, 'showService']);
Route::get('/popular/services', [FrontendController::class, 'popularServices']);
