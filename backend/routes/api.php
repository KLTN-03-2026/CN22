<?php

use App\Http\Controllers\ADChapterController;
use App\Http\Controllers\ADCourseController;
use App\Http\Controllers\ADLessonController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum', 'role:admin')->prefix('/admin')->group(function () {

    // ===== COURSE =====
    Route::get('/courses', [ADCourseController::class, 'index']);
    Route::post('/courses', [ADCourseController::class, 'store']);
    Route::get('/courses/{course}', [ADCourseController::class, 'show']);
    Route::put('/courses/{course}', [ADCourseController::class, 'update']);
    Route::delete('/courses/{course}', [ADCourseController::class, 'destroy']);

    // ===== CHAPTER =====
    Route::get('/courses/{course}/chapters', [ADChapterController::class, 'index']);
    Route::post('/courses/{course}/chapters', [ADChapterController::class, 'store']);
    Route::put('/chapters/{chapter}', [ADChapterController::class, 'update']);
    Route::delete('/chapters/{chapter}', [ADChapterController::class, 'destroy']);

    // ===== LESSON =====
    Route::get('/chapters/{chapter}/lessons', [ADLessonController::class, 'index']);
    Route::post('/chapters/{chapter}/lessons', [ADLessonController::class, 'store']);
    Route::put('/lessons/{lesson}', [ADLessonController::class, 'update']);
    Route::delete('/lessons/{lesson}', [ADLessonController::class, 'destroy']);


    // ===== USER =====

});


// Route công khai

Route::middleware('auth:sanctum')->get('/auth/me', [AuthController::class, 'me']);

Route::prefix('/auth')->group(function () {
    Route::get('/google', [GoogleAuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

});

// GET /api/courses - Danh sách khóa học (phân trang, lọc)
Route::get('/courses', [CourseController::class, 'index']);

Route::middleware('auth:sanctum', 'role:student')->group(function () {
    // Route::get('/me', [AuthController::class, 'me']);

    Route::get('/courses/{slug}', [CourseController::class, 'show']);
    // Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll']);

    // Route::get('/lessons/{id}', [LessonController::class, 'show']);
    Route::middleware(['auth:sanctum', 'lesson.access'])->group(function () {
        Route::get('/courses/{slug}/lessons/{lesson}', [LessonController::class, 'show']);
        Route::get('/lessons/{lesson}/quiz', [QuizController::class, 'getByLesson']);
        Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);
    });

    Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start']);

    Route::get('/lessons/{lesson}/coding', [CodeController::class, 'getByLesson']);
    Route::post('/code/submit', [CodeController::class, 'submit']);

    // ORDER
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);

    // PAYMENT
    Route::post('/payments/sepay/create', [PaymentController::class, 'create']);
});

// WEBHOOK (public)
Route::post('/payments/sepay/webhook', [PaymentController::class, 'webhook'])->middleware('sepay.verify');
