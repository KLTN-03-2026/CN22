<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\Request;

class ADCourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        return response()->json($this->courseService->getAllCourses());
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->courseService->createCourse($request->all())
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->courseService->getCourseById($id)
        );
    }

    public function update(Request $request, $id)
    {
        return response()->json(
            $this->courseService->updateCourse($id, $request->all())
        );
    }

    public function destroy($id)
    {
        $this->courseService->deleteCourse($id);
        return response()->json(['message' => 'Đã xóa khóa học thành công.']);
    }
}
