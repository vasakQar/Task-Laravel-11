<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Controllers\Api\V1\WebsiteController;
use App\Http\Controllers\Api\V1\Auth\AuthController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('register', 'register');
            Route::post('login', 'login');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', function (Request $request) {
            return $request->user();
        });

        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('websites/{id}/reports', [WebsiteController::class, 'websiteReports']);
        Route::apiResource('websites', WebsiteController::class);
        Route::apiResource('reports', ReportController::class);
    });
});

