<?php

use App\Http\Controllers\AdminAnalyticsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CourseHubController;
use App\Http\Controllers\FlaggedContentController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceReviewController;
use App\Http\Controllers\UniversityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/whoami' , function () {
    return response()->json ([
        'app' => 'THIS IS THE CORRECT LARAVEL APP' ,
        'path' => base_path (),
    ]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('universities', UniversityController::class);
    Route::apiResource('course-hubs', CourseHubController::class);
    Route::apiResource('resources', ResourceController::class)->except(['update']);
    Route::apiResource('resource-reviews', ResourceReviewController::class)->only(['store']);
    Route::apiResource('flagged-content', FlaggedContentController::class)->except(['update', 'show']);
    Route::post('/flagged-content/{flaggedContent}/approve', [FlaggedContentController::class, 'approve']);
    Route::post('/flagged-content/{flaggedContent}/reject', [FlaggedContentController::class, 'reject']);

    Route::get('/chat', [ChatController::class, 'index']);
    Route::post('/chat', [ChatController::class, 'store']);
    Route::get('/chat/{chatSession}', [ChatController::class, 'show']);
    Route::post('/chat/{chatSession}/messages', [ChatController::class, 'storeMessage']);

    Route::get('/admin/stats', [AdminAnalyticsController::class, 'index'])->middleware('admin');
});
