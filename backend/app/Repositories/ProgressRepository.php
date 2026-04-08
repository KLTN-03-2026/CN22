<?php
namespace App\Repositories;

use App\Models\LessonProgress;

class ProgressRepository
{
    public function getCompletedLessons($userId)
    {
        // Lấy danh sách lesson_id mà người dùng đã hoàn thành
        // Bảng lesson_progress có cấu trúc: id, user_id, lesson_id, status
        return LessonProgress::where('user_id', $userId)
            ->where('status', LessonProgress::COMPLETED)
            ->pluck('lesson_id')
            ->toArray();
    }

    public function markCompleted($userId, $lessonId)
    {
        // Cập nhật hoặc tạo mới bản ghi tiến độ với trạng thái 'completed'
        return LessonProgress::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            ['status' => LessonProgress::COMPLETED, 'completed_at' => now()]
        );
    }
}
