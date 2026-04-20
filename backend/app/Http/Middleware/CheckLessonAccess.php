<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\UserChapter;
use App\Services\LessonService;

class CheckLessonAccess
{
    protected LessonService $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $lessonId = $request->route('lesson');

        // Lấy lesson từ quiz
        if (!$lessonId && $request->route('quiz')) {
            $quiz = \App\Models\Quiz::find($request->route('quiz'));
            $lessonId = $quiz?->lesson_id;
        }

        $lesson = Lesson::with('chapter.course')->find($lessonId);

        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }

        // Sử dụng hàm chung từ Service
        if (!$this->lessonService->canAccessLesson($lesson, $user)) {
            return response()->json([
                'error' => 'Bạn chưa mua nội dung này'
            ], 403);
        }

        return $next($request);
    }
}
