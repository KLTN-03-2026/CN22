<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Topic;
use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    // Lấy chi tiết bài học
    public function show($slug, $id, Request $request)
    {
        return response()->json(
            $this->lessonService->getLessonDetail($slug, $id, $request->user())
        );
    }

    public function complete($id, Request $request)
    {
        $this->lessonService->markCompleted($id, $request->user());

        return response()->json([
            'message' => 'Bài học đã được đánh dấu hoàn thành!',
        ]);
    }


}
