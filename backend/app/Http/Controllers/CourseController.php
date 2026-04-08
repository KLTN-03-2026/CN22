<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    // Lấy danh sách khóa học
    public function index()
    {
        return response()->json(
            $this->courseService->getCourses()
        );
    }

    public function show($slug, Request $request)
    {
        return response()->json(
            $this->courseService->getCourseDetail($slug, $request->user())
        );
    }

    public function index2()
    {
        $courses = Course::all();
        // Course::withCount('topics')->get() số lượng topic luôn.
        return response()->json([
            'data' =>  $courses
        ]);
    }

    // public function store(Request $request)
    // {
    //     $course = Course::create($request->all());
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Tạo khóa học thành công!',
    //     ], 201);
    // }

    // public function update(Request $request, Course $course)
    // {
    //     $course->update($request->all());
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Cập nhật thành công!',
    //     ]);
    // }

    // public function destroy(Course $course)
    // {
    //     $course->delete();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Đã xóa khóa học!'
    //     ]);
    // }

}
