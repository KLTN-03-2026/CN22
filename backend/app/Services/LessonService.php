<?php

namespace App\Services;

use App\Models\Chapter;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserChapter;
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
        $lesson = $this->lessonRepo->findByIdWithRelations($lessonId);
        if (!$lesson) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
        }

        // Kiểm tra quyền truy cập
        if (!$this->canAccessLesson($lesson, $user)) {
            throw new AuthorizationException('Bạn chưa mua nội dung này.');
        }

        $progressData = $this->lessonRepo->getProgress($user->id);

        $isUnlocked = $this->checkLessonUnlock($lesson, $progressData, $user);

        $structure = $this->lessonRepo->getCourseStructure($lesson->chapter->id, $progressData);

        $exercise = $this->lessonRepo->getExercise($lesson->id);

        return [
            'id'                => $lesson->id,
            'title'             => $lesson->title,
            'content'           => $lesson->content,
            'videoUrl'          => $lesson->video_url,
            'isUnlocked'        => $isUnlocked,
            'scoreRequirement'  => $lesson->score_requirement,

            'progress' => [
                'percentage' => $progressData[$lesson->id]->score ?? 0,
            ],

            'exercise' => $exercise,
            'courseStructure' => $structure
        ];
    }

    public function canAccessLesson(Lesson $lesson, User $user): bool
    {
        // 1. Chapter miễn phí
        if ($lesson->chapter->is_free) {
            return true;
        }

        $courseId  = $lesson->chapter->course_id;
        $chapterId = $lesson->chapter->id;

        // 2. Đã mua toàn bộ khóa học
        $hasFullAccess = Enrollment::where([
            'user_id'     => $user->id,
            'course_id'   => $courseId,
            'access_type' => 'full'
        ])->exists();

        if ($hasFullAccess) {
            return true;
        }

        // 3. Đã mua riêng chapter
        $hasChapterAccess = UserChapter::where([
            'user_id'    => $user->id,
            'chapter_id' => $chapterId
        ])->exists();

        return $hasChapterAccess;
    }

    private function checkLessonUnlock($lesson, $progressData, $user): bool
    {
        $allLessons = $this->getAccessibleLessons(
            $lesson->chapter->course_id,
            $user
        );

        $index = $allLessons->search(fn($l) => $l->id === $lesson->id);

        // không nằm trong danh sách được phép xem → khóa
        if ($index === false) return false;

        // bài đầu tiên → mở
        if ($index === 0) return true;

        $prevLesson = $allLessons[$index - 1];
        $prevScore = $progressData[$prevLesson->id]->score ?? 0;

        return $prevScore >= $prevLesson->score_requirement;
    }

    /**
     * Lấy tất cả bài học mà user được phép xem (theo thứ tự)
     */
    private function getAccessibleLessons($courseId, $user)
    {
        $chapters = Chapter::with('lessons')
            ->where('course_id', $courseId)
            ->orderBy('order')
            ->get();

        $lessons = collect();

        foreach ($chapters as $chapter) {

            if (!$this->canAccessLessonForChapter($chapter, $user)) {
                continue; // bỏ chapter chưa mua
            }

            foreach ($chapter->lessons->sortBy('order') as $lesson) {
                $lessons->push($lesson);
            }
        }

        return $lessons->values();
    }

    /**
     * Kiểm tra quyền truy cập Chapter (dùng nội bộ)
     */
    private function canAccessLessonForChapter($chapter, $user): bool
    {
        // FREE
        if ($chapter->is_free) return true;

        // FULL COURSE
        $hasFull = Enrollment::where([
            'user_id'       => $user->id,
            'course_id'     => $chapter->course_id,
            'access_type'   => 'full'
        ])->exists();

        if ($hasFull) return true;

        // CHAPTER PURCHASE
        return UserChapter::where([
            'user_id'       => $user->id,
            'chapter_id'    => $chapter->id
        ])->exists();
    }

    public function markCompleted($lessonId, $user)
    {
        return $this->progressRepo->markCompleted($user->id, $lessonId);
    }
}
