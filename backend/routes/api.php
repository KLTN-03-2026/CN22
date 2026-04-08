<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin'], function () {
    // Course
    Route::get('/courses', [CourseController::class, 'index2']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update']);
    Route::delete('/courses/{course}', [CourseController::class, 'destroy']);

    // Topic
    Route::scopeBindings()->group(function () {
        Route::get('/courses/{course}/topics', [ChapterController::class, 'index']);
        Route::post('/courses/{course}/topics', [ChapterController::class, 'store']);
        Route::put('/courses/{course}/topics/{topic}', [ChapterController::class, 'update']);
        Route::delete('/courses/{course}/topics/{topic}', [ChapterController::class, 'destroy']);
    });

    // Lesson
    Route::scopeBindings()->group(function () {
        Route::get('/topics/{topic}/lessons', [LessonController::class, 'index']);
        Route::post('/topics/{topic}/lessons', [LessonController::class, 'store']);
        Route::put('/topics/{topic}/lessons/{lesson}', [LessonController::class, 'update']);
        Route::delete('/topics/{topic}/lessons/{lesson}', [LessonController::class, 'destroy']);
    });

});


// Route công khai

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/auth')->group(function () {
    Route::get('/google', [GoogleAuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// GET /api/courses - Danh sách khóa học (phân trang, lọc)
Route::get('/courses', [CourseController::class, 'index']);

Route::get('/lessons/{id}', [LessonController::class, 'show']);
Route::middleware('auth:sanctum', 'role:student')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/courses/{slug}', [CourseController::class, 'show']);

    Route::post('/courses/{id}/enroll', [EnrollmentController::class, 'enroll']);
    Route::get('/courses/{slug}/lessons/{id}', [LessonController::class, 'show']);
});

// // Public routes
// GET /api/courses/{slug}/chapters - Danh sách chương của khóa học

// // Student routes (yêu cầu đăng nhập)
// POST /api/courses/{id}/enroll - Đăng ký khóa học
// GET /api/my-courses - Khóa học của tôi
// GET /api/my-courses/{id}/progress - Progress khóa học
// GET /api/my-courses/{id}/certificate - Tải chứng chỉ

// // Instructor routes
// POST /api/instructor/courses - Tạo khóa học mới
// PUT /api/instructor/courses/{id} - Cập nhật khóa học
// DELETE /api/instructor/courses/{id} - Xóa khóa học
// POST /api/instructor/courses/{id}/publish - Xuất bản khóa học
// Learning routes
// GET /api/courses/{courseId}/chapters/{chapterId}/lessons/{lessonId} - Xem bài học
// POST /api/lessons/{id}/start - Bắt đầu bài học
// POST /api/lessons/{id}/complete - Hoàn thành bài học
// POST /api/lessons/{id}/update-progress - Cập nhật progress (video position, reading time)

// // Quiz routes
// GET /api/quizzes/{id}/start - Bắt đầu làm quiz
// POST /api/quizzes/{id}/submit - Nộp bài quiz
// GET /api/quizzes/{id}/results/{resultId} - Xem kết quả quiz

// // Coding exercise routes
// GET /api/coding-exercises/{id} - Xem đề bài
// POST /api/coding-exercises/{id}/submit - Nộp bài code
// GET /api/coding-exercises/{id}/submissions - Lịch sử nộp bài
// GET /api/submissions/{id}/results - Kết quả chi tiết submission
