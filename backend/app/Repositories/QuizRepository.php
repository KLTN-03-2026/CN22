<?php

namespace App\Repositories;

use App\Models\LessonProgress;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

class QuizRepository
{
    public function findByLesson($lessonId)
    {
        return Quiz::with(['questions.answers'])
            ->where('lesson_id', $lessonId)
            ->where('is_active', 1)
            ->first();
    }

    public function getQuizWithQuestions($quizId)
    {
        return Quiz::with(['questions.answers'])
            ->find($quizId);
    }

    public function createQuizResult($data)
    {
        return DB::table('quiz_results')->insertGetId($data)
            ? DB::table('quiz_results')->latest('id')->first()
            : null;
    }

    public function updateQuizResult($id, $data)
    {
        DB::table('quiz_results')->where('id', $id)->update($data);
    }

    public function createUserAnswer($data)
    {
        DB::table('user_answers')->insert($data);
    }

    public function updateLessonProgress($userId, $lessonId, $score)
    {
        DB::table('lesson_progress')->updateOrInsert(
            [
                'user_id' => $userId,
                'lesson_id' => $lessonId
            ],
            [
                'score' => $score,
                'status' => $score >= 70 ? LessonProgress::COMPLETED : LessonProgress::IN_PROGRESS,
                'completed_at' => $score >= 70 ? now() : null
            ]
        );
    }
}
