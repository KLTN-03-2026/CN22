<?php

namespace App\Services;

use App\Repositories\CourseRepository;
use App\Repositories\ProgressRepository;
use App\Services\LessonService;

class CourseService
{
    protected $courseRepo;
    protected $lessonService;
    protected $progressRepo;

    public function __construct(
        CourseRepository $courseRepo,
        LessonService $lessonService,
        ProgressRepository $progressRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->lessonService = $lessonService;
        $this->progressRepo = $progressRepo;
    }

    public function getCourses()
    {
        return $this->courseRepo->getAll();
    }

    public function getCourseDetail($slug, $user)
    {
        $course = $this->courseRepo->findWithRelations($slug);
        // ===== Load data =====
        $isEnrolled = $user
            ? $this->courseRepo->enrolledCourse($course->id, $user->id)
            : false;

        $progressData = $user
            ? $this->courseRepo->getLessonProgress($user->id)
            : [];


        $paidChapters = $user
            ? $this->courseRepo->getPaidChapters($user->id)
            : [];

        // ===== Transform =====
        $chapters = $course->chapters
            ->sortBy('order')
            ->map(function ($chapter) use ($user, $isEnrolled, $paidChapters, $progressData) {

                $hasAccess = $this->checkChapterAccess(
                    $chapter,
                    $user,
                    $isEnrolled,
                    $paidChapters
                );

                $lessons = $this->transformLessons(
                    $chapter->lessons,
                    $hasAccess,
                    $progressData
                );

                return [
                    'id' => $chapter->id,
                    'title' => $chapter->title,
                    'order' => $chapter->order,
                    'description' => $chapter->description,
                    'is_free' => $chapter->is_free,
                    'price' => $chapter->price,
                    'is_accessible' => $hasAccess,
                    'lessons' => $lessons
                ];
            });

        // ===== Progress =====
        $progress = $this->calculateCourseProgress($chapters);
        foreach ($chapters as $chapter) {
            foreach ($chapter['lessons'] as $lesson) {
                if (!json_encode($lesson)) {
                    dd($lesson, json_last_error_msg());
                }
            }
        }

        $courseData = [
            'id'           => $course->id,
            'title'        => $course->title,
            'description'  => $course->description,
            'price'        => $course->price,
            'is_registered' => $isEnrolled,
            'progress'     => $progress,
            'chapters'     => json_decode(json_encode($chapters, JSON_UNESCAPED_UNICODE), true)
        ];
        return $courseData;
    }

    private function checkChapterAccess($chapter, $user, $isEnrolled, $paidChapters)
    {
        // free
        if (!$chapter->is_free) return true;

        if (!$user) return false;

        // mua khóa
        if ($isEnrolled) return true;

        // mua chương
        if (in_array($chapter->id, $paidChapters)) return true;

        return false;
    }

    private function transformLessons($lessons, $hasAccess, $progressData)
    {
        $lessons = $lessons->sortBy('order')->values();

        return $lessons->map(function ($lesson, $index) use ($lessons, $hasAccess, $progressData) {

            $score = $this->getLessonScore($lesson->id, $progressData);

            $isCompleted = $score >= $lesson->score_requirement;

            [$isUnlocked, $condition] = $this->checkLessonUnlock(
                $lesson,
                $index,
                $lessons,
                $hasAccess,
                $progressData
            );

            return [
                'id' => $lesson->id,
                'title' => $lesson->title,
                'description' => mb_substr($lesson->content, 0),
                'video_url' => $lesson->video_url,
                'score_requirement' => $lesson->score_requirement,
                'progress' => $score,
                'is_completed' => $isCompleted,
                'is_unlocked' => true, //note: tạm thời bỏ check unlock để test, sau này sẽ mở lại
                'unlock_condition' => $condition
            ];
        });
    }

    private function checkLessonUnlock($lesson, $index, $lessons, $hasAccess, $progressData)
    {
        if ($hasAccess) {
            return [false, 'Chưa mua khóa học'];
        }

        if ($index === 0) {
            return [true, null];
        }

        $prevLesson = $lessons[$index - 1];
        $prevScore = $progressData[$prevLesson->id]->score ?? 0;

        if ($prevScore >= $prevLesson->score_requirement) {
            return [true, null];
        }

        return [false, 'Cần hoàn thành bài trước'];
    }

    private function calculateCourseProgress($chapters)
    {
        $total = 0;
        $completed = 0;

        foreach ($chapters as $chapter) {
            foreach ($chapter['lessons'] as $lesson) {
                $total++;

                if ($lesson['is_completed']) {
                    $completed++;
                }
            }
        }

        return $total > 0 ? round(($completed / $total) * 100) : 0;
    }

    private function getLessonScore($lessonId, $progressData)
    {
        return $progressData[$lessonId]->score ?? 0;
    }
}
