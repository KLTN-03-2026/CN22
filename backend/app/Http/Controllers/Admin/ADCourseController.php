<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use Str;

class ADCourseController extends Controller
{
    // GET /admin/courses
    public function index()
    {
        $courses = Course::with('chapters')->latest()->paginate(10);
        return response()->json($courses);
    }

    // POST /admin/courses
    public function store(CourseRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $data['slug'] = Str::slug($request->title);

        $course = Course::create($data);

        return response()->json($course, 201);
    }

    // GET /admin/courses/{course}
    public function show(Course $course)
    {
        return response()->json($course->load('chapters.lessons'));
    }

    // PUT /admin/courses/{course}
    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                \Storage::disk('public')->delete($course->thumbnail);
            }
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $path;
        } elseif ($request->filled('thumbnail') && filter_var($request->thumbnail, FILTER_VALIDATE_URL)) {
            // Nếu trước đó là file local thì xóa đi cho sạch server
            if ($course->thumbnail && \Storage::disk('public')->exists($course->thumbnail)) {
                \Storage::disk('public')->delete($course->thumbnail);
            }
        }

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $course->update($data);

        return response()->json($course);
    }

    // DELETE /admin/courses/{course}
    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            \Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();
        return response()->json(null, 204);
    }
}
