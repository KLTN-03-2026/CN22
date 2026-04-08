<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ProgressRepository;
use Illuminate\Auth\Access\AuthorizationException;

class LessonService
{
    protected $lessonRepo;
    protected $progressRepo;
    protected $courseRepo;

    public function __construct(LessonRepository $lessonRepo, ProgressRepository $progressRepo, CourseRepository $courseRepo)
    {
        $this->lessonRepo = $lessonRepo;
        $this->progressRepo = $progressRepo;
        $this->courseRepo = $courseRepo;
    }

    public function getLessonDetail($slug, $lessonId, $user)
    {
        // ===== 1. Lấy lesson + course =====
        $lesson = $this->lessonRepo->findByIdWithRelations($lessonId);

        $course = $this->courseRepo->findWithRelations($slug);

        // ===== 2. Check access =====
        $isEnrolled = $this->courseRepo->enrolledCourse($course->id, $user->id);

        if (!$isEnrolled) {
            return [
                'error' => 'Bạn chưa đăng ký khóa học'
            ];
        }

        // ===== 3. Progress =====
        $progressData = $this->lessonRepo->getProgress($user->id);

        $score = $progressData[$lesson->id]->score ?? 0;

        $isCompleted = $score >= $lesson->score_requirement;

        // ===== 4. Check unlock =====
        $isUnlocked = $this->checkLessonUnlock($lesson, $progressData);

        // ===== 5. Lấy course structure (sidebar) =====
        $structure = $this->lessonRepo->getCourseStructure($course->id, $progressData);

        // ===== 6. Lấy exercise =====
        $exercise = $this->lessonRepo->getExercise($lesson->id);

        // ===== 7. Return =====
        return [
            'id' => $lesson->id,
            'title' => $lesson->title,
            'content' => $lesson->content,
            'videoUrl' => $lesson->video_url,
            'isUnlocked' => true,
            'scoreRequirement' => $lesson->score_requirement,

            'progress' => [
                'percentage' => $score
            ],

            'exercise' => $exercise,

            'courseStructure' => $structure
        ];
    }
    private function checkLessonUnlock($lesson, $progressData)
    {
        return true;
        // ===== 1. Lấy bài trước trong cùng chapter =====
        $prevLesson = $this->lessonRepo->getPreviousLesson($lesson);

        // ===== 2. Nếu KHÔNG có bài trước → bài đầu tiên → MỞ =====
        if (!$prevLesson) {
            return true;
        }

        // ===== 3. Check điểm bài trước =====
        $prevScore = $progressData[$prevLesson->id]->score ?? 0;

        return $prevScore >= $prevLesson->score_requirement;
    }

    public function checkLessonAccess($lesson, $user)
    {
        // miễn phí
        if ($lesson->chapter->is_free) return true;

        // TODO: check purchase
        return true;
    }

    public function markCompleted($lessonId, $user)
    {
        return $this->progressRepo->markCompleted($user->id, $lessonId);
    }
}
