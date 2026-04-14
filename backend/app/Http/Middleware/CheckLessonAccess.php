<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\UserChapter;

class CheckLessonAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        // 1. LẤY lesson
        $lessonId = $request->route('lessonId');

        $lesson = Lesson::with('chapter.course')->find($lessonId);

        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }

        $courseId = $lesson->chapter->course->id;
        $chapterId = $lesson->chapter->id;

        // 2. CHECK FULL COURSE
        $hasFullAccess = Enrollment::where([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'access_type' => 'full'
        ])->exists();

        if ($hasFullAccess) {
            return $next($request);
        }

        // 3. CHECK CHAPTER ACCESS
        $hasChapterAccess = UserChapter::where([
            'user_id' => $user->id,
            'chapter_id' => $chapterId
        ])->exists();

        if ($hasChapterAccess) {
            return $next($request);
        }

        // 4. KHÔNG CÓ QUYỀN
        return response()->json([
            'error' => 'Bạn chưa mua nội dung này'
        ], 403);

        if ($lesson->is_free) {
            return $next($request);
        }
    }
}
