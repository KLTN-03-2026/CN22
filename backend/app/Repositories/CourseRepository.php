<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CourseRepository
{
    // Tìm khóa học theo ID
    public function findById($id)
    {
        return DB::table('courses')
            ->where('id', $id)
            ->first();
    }

    // Lấy tất cả khóa học (có thể thêm phân trang, lọc sau)
    public function getAll()
    {
        $data = Course::withCount('chapters')
                        ->where('status', Course::ACTIVE)
                        ->get();
        return $data;
    }

    // Lấy chi tiết khóa học kèm theo chương và bài học
    public function findWithRelations($slug)
    {
        $data = Course::with(['chapters.lessons'])->where('slug', $slug)->firstOrFail();
        return $data;
    }

    // Kiểm tra người dùng đã đăng ký khóa học chưa
    public function enrolledCourse($courseId, $userId)
    {
        return DB::table('enrollments')
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();
    }

    // Lấy tiến độ học bài của người dùng
    public function getLessonProgress($userId)
    {
        return DB::table('lesson_progress')
            ->where('user_id', $userId)
            ->get()
            ->keyBy('lesson_id');
    }

    // Lấy danh sách chương đã mua của người dùng
    public function getPaidChapters($userId)
    {
        return DB::table('orders')
            ->where('user_id', $userId)
            ->whereNotNull('chapter_id')
            ->where('status', Order::STATUS_PAID)
            ->pluck('chapter_id')
            ->toArray();
    }
}
