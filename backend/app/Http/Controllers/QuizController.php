<?php

namespace App\Http\Controllers;

use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    public function getByLesson($lessonId)
    {
        $quiz = $this->quizService->getQuizByLesson($lessonId);

        return response()->json($quiz);
    }

    public function submit($quizId, Request $request)
    {
        $user = $request->user();

        $result = $this->quizService->submitQuiz(
            $quizId,
            $user,
            $request->input('answers', [])
        );

        return response()->json($result);
    }
}
