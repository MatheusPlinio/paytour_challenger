<?php

use App\Http\Controllers\Api\JobApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post("/job_applications", [JobApplicationController::class, 'store'])->name('job_applications.store');
});
