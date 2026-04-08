<?php

namespace App\Http\Controllers;

use App\Services\EnrollService;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    protected $enrollService;

    public function __construct(EnrollService $enrollService)
    {
        $this->enrollService = $enrollService;
    }

    public function enroll($courseId, Request $request)
    {
        return response()->json(
            $this->enrollService->enrollCourse($courseId, $request->user())
        );
    }
}
