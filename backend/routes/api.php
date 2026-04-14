<?php

use App\Http\Controllers\Admin\ADChapterController;
use App\Http\Controllers\Admin\ADCourseController;
use App\Http\Controllers\Admin\ADLessonController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
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
});


// Route công khai

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
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

Route::get('/courses/{slug}', [CourseController::class, 'show']);
Route::middleware('auth:sanctum', 'role:student')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll']);
    Route::get('/courses/{slug}/lessons/{id}', [LessonController::class, 'show']);

    Route::get('/lessons/{id}', [LessonController::class, 'show']);
    Route::middleware(['auth:sanctum', 'lesson.access'])->group(function () {
    Route::get('/lessons/{lessonId}', [LessonController::class, 'show']);
});

    Route::get('/lessons/{lesson}/quiz', [QuizController::class, 'getByLesson']);
    Route::post('/quizzes/{quiz}/start', [QuizController::class, 'start']);
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit']);

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
