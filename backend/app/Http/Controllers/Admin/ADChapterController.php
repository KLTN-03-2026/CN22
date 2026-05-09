<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChapterRequest;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Http\Request;

class ADChapterController extends Controller
{
    // GET /admin/courses/{course}/chapters
    public function index(Course $course)
    {
        $chapters = $course->chapters()->orderBy('order')->get();
        return response()->json($chapters);
    }

    // POST /admin/courses/{course}/chapters
    public function store(ChapterRequest $request, Course $course)
    {
        $data = $request->all();

        $data['course_id'] = $course->id;
        $data['order'] = $data['order'] ?? ($course->chapters()->count() + 1);

        $chapter = Chapter::create($data);

        return response()->json($chapter, 201);
    }

    // PUT /admin/chapters/{chapter}
    public function update(ChapterRequest $request, Chapter $chapter)
    {
        $data = $request->all();

        if (isset($data['order'])) {
            // Cập nhật lại order các chapter khác nếu cần
            if ($data['order'] !== $chapter->order) {
                $course = $chapter->course;
                $chapters = $course->chapters()->orderBy('order')->get();

                foreach ($chapters as $c) {
                    if ($c->id === $chapter->id) continue;

                    if ($c->order >= $data['order'] && $c->order < $chapter->order) {
                        $c->increment('order');
                    } elseif ($c->order <= $data['order'] && $c->order > $chapter->order) {
                        $c->decrement('order');
                    }
                }
            }
        }

        $chapter->update($data);

        return response()->json($chapter);
    }

    // DELETE /admin/chapters/{chapter}
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();

        // Cập nhật lại order các chapter còn lại
        $course = $chapter->course;
        $chapters = $course->chapters()->orderBy('order')->get();

        foreach ($chapters as $index => $c) {
            $c->update(['order' => $index + 1]);
        }

        return response()->json(null, 204);
    }
}
