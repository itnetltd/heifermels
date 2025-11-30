<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ParticipantController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\SubmissionController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('participants', ParticipantController::class);
    Route::apiResource('forms', FormController::class);
    Route::apiResource('submissions', SubmissionController::class);

    Route::get('dashboard/overview', [\App\Http\Controllers\Api\DashboardController::class, 'overview']);
});
