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

        $isEnrolled = $user
            ? $this->courseRepo->enrolledCourse($course->id, $user->id)
            : false;

        $progressData = $user
            ? $this->courseRepo->getLessonProgress($user->id)
            : [];


        $paidChapters = $user
            ? $this->courseRepo->getPaidChapters($user->id)
            : [];


        $chapters = $course->chapters
            ->sortBy('order')
            ->map(function ($chapter) use ($isEnrolled, $paidChapters, $progressData) {

                $hasAccess = $this->checkChapterAccess(
                    $chapter,
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
        // tính tổng số bài học và số bài đã hoàn thành để tính progress khóa học
        $progress = $this->calculateCourseProgress($chapters);

        $courseData = [
            'id'           => $course->id,
            'title'        => $course->title,
            'description'  => $course->description,
            'price'        => $course->price,
            'is_enrolled'  => $isEnrolled,
            'progress'     => $progress,
            'chapters'     => json_decode(json_encode($chapters, JSON_UNESCAPED_UNICODE), true)
        ];

        return $courseData;
    }

    // Kiểm tra quyền truy cập chương
    private function checkChapterAccess($chapter, $isEnrolled, $paidChapters)
    {
        // FREE → luôn được học
        if ($chapter->is_free) return true;

        // FULL COURSE
        if ($isEnrolled) return true;

        // MUA LẺ CHƯƠNG
        if (in_array($chapter->id, $paidChapters)) return true;

        return false;
    }



    // transform bài học, thêm thông tin is_accessible, is_completed, progress vào từng bài học
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
                'order' => $lesson->order,
                'is_completed' => $isCompleted,
                'is_unlocked' => $isUnlocked,
                'unlock_condition' => $condition
            ];
        });
    }

    // Kiểm tra điều kiện mở khóa bài học
    private function checkLessonUnlock($lesson, $index, $lessons, $hasAccess, $progressData)
    {
        // ===== 1. Không có quyền truy cập =====
        if (!$hasAccess) {
            return [false, 'Chưa mua khóa học hoặc chương'];
        }

        // ===== 2. Bài đầu tiên luôn mở =====
        if ($index === 0) {
            return [true, null];
        }

        // ===== 3. Lấy bài trước =====
        $prevLesson = $lessons[$index - 1];

        $prevScore = $progressData[$prevLesson->id]->score ?? 0;

        // ===== 4. Check điều kiện =====
        if ($prevScore >= $prevLesson->score_requirement) {
            return [true, null];
        }

        return [false, 'Cần đạt >= ' . $prevLesson->score_requirement . '% bài trước'];
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
        return 70; // note: giả lập điểm để test, sau này sẽ lấy từ $progressData
        return $progressData[$lessonId]->score ?? 0;
    }





    //=========================================================================================
    //=========================================================================================
    //============================== ADMIN ====================================================
    //=========================================================================================
    //=========================================================================================

    public function getAllCourses()
    {
        return $this->courseRepo->getAll();
    }

    public function createCourse($data)
    {
        return $this->courseRepo->create($data);
    }

    public function getCourseById($id)
    {
        return $this->courseRepo->find($id);
    }

    public function updateCourse($id, $data)
    {
        return $this->courseRepo->update($id, $data);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepo->delete($id);
    }
}
