<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Course $course)
    {
        $chapters = $course->chapters()->withCount('lessons')->orderBy('order')->get();

        if ($chapters->isEmpty()) {
            return response()->json([
                'message' => 'Khóa học "' . $course->name . '" hiện chưa có chủ đề nào.',
            ]);
        }

        return response()->json([
            'count' => $chapters->count(),
            'data' => $chapters
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $course->chapters()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Đã thêm chapter vào khóa học!',
        ], 201);
    }

    public function update(Request $request, Course $course, Chapter $chapter)
    {
        $chapter->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật chapter thành công!',
        ]);
    }

    public function destroy(Course $course, Chapter $chapter)
    {
        $chapter->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa chủ đề!'
        ]);
    }
}
