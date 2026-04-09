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

        // ===== Transform =====
        // sắp xếp chương theo order, bài học theo order, thêm thông tin is_accessible, is_completed, progress vào từng bài học
        // với is_accessible: nếu là chương free thì luôn true, nếu đã đăng ký khóa học thì true, nếu đã mua chương thì true, ngược lại false
        // với is_completed: điểm của bài học >= điểm yêu cầu thì true, ngược lại false
        // với progress: lấy từ bảng lesson_progress, nếu chưa có thì mặc định 0
        // với unlock_condition: nếu chưa mua khóa học thì "Chưa mua khóa học", nếu chưa mua chương thì "Chưa mua chương", nếu chưa hoàn thành bài trước thì "Cần hoàn thành bài trước"
        // lưu ý: nếu chưa đăng nhập thì chỉ hiển thị được chương free, còn lại đều bị khóa với lý do "Chưa đăng nhập"
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
            'is_registered' => $isEnrolled,
            'progress'     => $progress,
            'chapters'     => json_decode(json_encode($chapters, JSON_UNESCAPED_UNICODE), true)
        ];

        return $courseData;
    }

    // Kiểm tra quyền truy cập chương
    private function checkChapterAccess($chapter, $isEnrolled, $paidChapters)
    {
        // chương free và đã đăng ký khóa học thì có quyền truy cập
        if ($chapter->is_free && $isEnrolled) return true;

        // đã mua chương
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
        // nếu chưa có quyền truy cập chương và bài học không phải là free thì khóa
        if (!$hasAccess && !$lesson->chapters->is_free) {
            return [false, 'Chưa mua chương học này'];
        }
        elseif (!$hasAccess && $lesson->chapters->is_free) {
            return [false, 'Chưa đăng ký khóa học'];
        }

        // nếu là bài học đầu tiên của chương đầu tiên và chương đó miễn phí thì luôn mở khóa
        if ($index == 0 && $lesson->chapters->is_free) {
            return [true, null];
        }

        // nếu chưa hoàn thành bài học trước thì khóa, với bài học đầu tiên của chương đầu tiên thì không cần kiểm tra, còn lại thì phải kiểm tra bài học trước đó đã hoàn thành chưa
        if ($index >= 0) {
            $prevChapter = $lesson->chapters;
            $prevLessons = $prevChapter->lessons->sortBy('order')->values();
            $prevLesson = $prevLessons->last();
            $prevScore = $progressData[$prevLesson->id]->score ?? 0;

            if ($prevScore < $prevLesson->score_requirement) {
                return [false, 'Cần hoàn thành bài trước để mở khóa'];
            }
        }

        return [true, null];
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
}
