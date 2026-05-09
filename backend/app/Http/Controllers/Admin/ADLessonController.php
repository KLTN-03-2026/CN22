<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ADLessonController extends Controller
{
    // GET /admin/chapters/{chapter}/lessons
    public function index(Chapter $chapter)
    {
        $lessons = $chapter->lessons()->orderBy('order')->get();
        return response()->json($lessons);
    }

    // POST /admin/chapters/{chapter}/lessons
    public function store(LessonRequest $request, Chapter $chapter)
    {
        $data = $request->all();

        $data['chapter_id'] = $chapter->id;
        $data['order'] = $data['order'] ?? ($chapter->lessons()->count() + 1);

        $lesson = Lesson::create($data);

        return response()->json($lesson, 201);
    }

    // PUT /admin/lessons/{lesson}
    public function update(LessonRequest $request, Lesson $lesson)
    {
        $data = $request->all();

        if (isset($data['order'])) {
            // Cập nhật lại order các lesson khác nếu cần
            if ($data['order'] !== $lesson->order) {
                $chapter = $lesson->chapter;
                $lessons = $chapter->lessons()->orderBy('order')->get();

                foreach ($lessons as $l) {
                    if ($l->id === $lesson->id) continue;

                    if ($l->order >= $data['order'] && $l->order < $lesson->order) {
                        $l->increment('order');
                    } elseif ($l->order <= $data['order'] && $l->order > $lesson->order) {
                        $l->decrement('order');
                    }
                }
            }
        }

        $lesson->update($data);

        return response()->json($lesson);
    }

    // DELETE /admin/lessons/{lesson}
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        // Cập nhật lại order các lesson còn lại
        $chapter = $lesson->chapter;
        $lessons = $chapter->lessons()->orderBy('order')->get();

        foreach ($lessons as $index => $l) {
            $l->update(['order' => $index + 1]);
        }

        return response()->json(null, 204);
    }
}
