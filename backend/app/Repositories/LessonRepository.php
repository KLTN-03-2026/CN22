<?php
namespace App\Repositories;

use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Quiz;

class LessonRepository
{
    public function findByIdWithRelations($id)
    {
        return Lesson::with(['chapters.courses'])->findOrFail($id);
    }

    public function getProgress($userId)
    {
        return LessonProgress::where('user_id', $userId)
            ->get()
            ->keyBy('lesson_id');
    }

    public function getPreviousLesson($lesson)
    {
        return Lesson::where('chapter_id', $lesson->chapter_id)
            ->where('order', '<', $lesson->order)
            ->orderByDesc('order')
            ->first();
    }

    public function getCourseStructure($courseId, $progressData)
    {
        $chapters = Chapter::with('lessons')
            ->where('course_id', $courseId)
            ->orderBy('order')
            ->get();

        return $chapters->map(function ($chapter) use ($progressData) {

            return [
                'id' => $chapter->id,
                'title' => $chapter->title,
                'lessons' => $chapter->lessons->map(function ($lesson) use ($progressData) {

                    $score = $progressData[$lesson->id]->score ?? 0;

                    return [
                        'id' => $lesson->id,
                        'title' => $lesson->title,
                        'isUnlocked' => true, // đổi nếu có logic mở khóa sau
                        'scoreRequirement' => 70,
                        'completed' => $score >= $lesson->score_requirement
                    ];
                })
            ];
        });
    }

    public function getExercise($lessonId)
    {
        $quiz = Quiz::where('lesson_id', $lessonId)->first();

        if (!$quiz) return null;

        return [
            'type' => 'quiz',
            'questions' => $quiz->questions->map(function ($q) {
                return [
                    'id' => $q->id,
                    'question' => $q->content,
                    'options' => $q->answers
                ];
            })
        ];
    }
}
