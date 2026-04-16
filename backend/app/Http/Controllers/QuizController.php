<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuizService;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    // ===== GET QUIZ =====
    public function getByLesson($lessonId)
    {
        return response()->json(
            $this->quizService->getQuizByLesson($lessonId)
        );
    }

    // ===== START QUIZ =====
    // public function start($quizId, Request $request)
    // {
    //     return response()->json(
    //         $this->quizService->startQuiz($quizId, $request->user())
    //     );
    // }

    // ===== SUBMIT QUIZ =====
    public function submit($quizId, Request $request)
    {
        return response()->json(
            $this->quizService->submitQuiz(
                $quizId,
                $request->user(),
                $request->input('answers', []),
                $request->input('attempt_id')
            )
        );
    }
}
