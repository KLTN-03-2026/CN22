<?php

namespace App\Http\Controllers;

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
}
