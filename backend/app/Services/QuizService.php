<?php

namespace App\Services;

use App\Repositories\QuizRepository;
use Illuminate\Support\Facades\DB;

class QuizService
{
    protected $quizRepo;

    public function __construct(QuizRepository $quizRepo)
    {
        $this->quizRepo = $quizRepo;
    }

    public function getQuizByLesson($lessonId)
    {
        $quiz = $this->quizRepo->findByLesson($lessonId);

        if (!$quiz) {
            throw new \Exception('Không có quiz cho bài học này');
        }

        return $this->transformQuiz($quiz);
    }

    private function transformQuiz($quiz)
    {
        return [
            'id' => $quiz->id,
            'title' => $quiz->title,
            'time_limit' => $quiz->time_limit,
            'questions' => $quiz->questions->shuffle()->map(function ($q) {
                return [
                    'id' => $q->id,
                    'content' => $q->content,
                    'answers' => $q->answers->shuffle()->map(function ($a) {
                        return [
                            'id' => $a->id,
                            'content' => $a->content
                        ];
                    })
                ];
            })
        ];
    }

    // public function startQuiz($quizId, $user)
    // {
    //     $quiz = $this->quizRepo->findById($quizId);

    //     $attemptCount = $this->quizRepo->countUserAttempts($quizId, $user->id);

    //     if ($quiz->max_times && $attemptCount >= $quiz->max_times) {
    //         throw new \Exception('Bạn đã hết lượt làm bài');
    //     }

    //     return $this->quizRepo->createQuizResult([
    //         'user_id' => $user->id,
    //         'quiz_id' => $quizId,
    //         'score' => 0,
    //         'started_at' => now(),
    //         'submitted_at' => null,
    //         'is_passed' => 0
    //     ]);
    // }
    public function submitQuiz($quizId, $user, $answers)
    {
        return DB::transaction(function () use ($quizId, $user, $answers) {

            // ===== 1. Lấy quiz + questions + answers =====
            $quiz = $this->quizRepo->getQuizWithQuestions($quizId);

            if (!$quiz) {
                throw new \Exception('Quiz không tồn tại');
            }

            $totalQuestions = $quiz->questions->count();
            $correctCount = 0;

            // ===== 2. Tạo quiz_result =====
            $result = $this->quizRepo->createQuizResult([
                'user_id' => $user->id,
                'quiz_id' => $quizId,
                'score' => 0,
                'started_at' => now(),
                'submitted_at' => now(),
                'is_passed' => 0
            ]);

            // ===== 3. Chấm từng câu =====
            foreach ($quiz->questions as $question) {

                // user chọn gì
                $userAnswer = collect($answers)
                    ->firstWhere('question_id', $question->id);

                $selectedAnswerId = $userAnswer['answer_id'] ?? null;

                // đáp án đúng
                $correctAnswer = $question->answers
                    ->firstWhere('is_correct', 1);

                $isCorrect = $correctAnswer && $correctAnswer->id == $selectedAnswerId;

                if ($isCorrect) {
                    $correctCount++;
                }

                // ===== lưu user_answers =====
                $this->quizRepo->createUserAnswer([
                    'result_id' => $result->id,
                    'question_id' => $question->id,
                    'answer_id' => $selectedAnswerId,
                    'is_correct' => $isCorrect ? 1 : 0,
                    'score' => $isCorrect ? (100 / $totalQuestions) : 0
                ]);
            }

            // ===== 4. Tính điểm =====
            $score = $totalQuestions > 0
                ? round(($correctCount / $totalQuestions) * 100)
                : 0;

            $isPassed = $score >= $quiz->pass_score;

            // ===== 5. Update result =====
            $this->quizRepo->updateQuizResult($result->id, [
                'score' => $score,
                'is_passed' => $isPassed
            ]);

            // ===== 6. Update lesson_progress =====
            if ($quiz->lesson_id) {
                $this->quizRepo->updateLessonProgress(
                    $user->id,
                    $quiz->lesson_id,
                    $score
                );
            }
            // ==== 7. Check time limit ====
            $startTime = strtotime($result->started_at);
            $now = time();

            if ($quiz->time_limit) {
                $limit = $quiz->time_limit * 60;

                if (($now - $startTime) > $limit) {
                    throw new \Exception('Hết thời gian làm bài');
                }
            }

            return [
                'score' => $score,
                'is_passed' => $isPassed,
                'correct' => $correctCount,
                'total' => $totalQuestions,
                'message' => $isPassed
                    ? 'Chúc mừng! Bạn đã vượt qua bài kiểm tra'
                    : 'Bạn chưa đạt. Hãy thử lại!'
            ];
        });
    }
}
