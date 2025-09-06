<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
        Route::post('/register', [AuthController::class, 'register'])->name('api.register');
        Route::post('/login', [AuthController::class, 'login'])->name('api.login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');
    });

    Route::prefix('job-applications')->group(function () {
        Route::get("/", [JobApplicationController::class, 'index'])->name('job_applications.index')->middleware('auth:sanctum');
        Route::get("/show/{job_application}", [JobApplicationController::class, 'show'])->name('job_applications.show');
        Route::post("/store", [JobApplicationController::class, 'store'])->name('job_applications.store');
        Route::delete("/delete/{job_application}", [JobApplicationController::class, 'delete'])->name('job_applications.delete');
    });
});
