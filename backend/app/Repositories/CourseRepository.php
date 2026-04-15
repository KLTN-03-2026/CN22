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

    public function getPaidChapters($userId)
    {
        return DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.user_id', $userId)
            ->where('orders.status', Order::STATUS_PAID)
            ->whereNotNull('order_items.chapter_id')
            ->pluck('order_items.chapter_id')
            ->toArray();
    }


    public function create($data)
    {
        return Course::create($data);
    }

    public function find($id)
    {
        return Course::findOrFail($id);
    }

    public function update($id, $data)
    {
        $course = $this->find($id);
        $course->update($data);
        return $course;
    }

    public function delete($id)
    {
        return Course::destroy($id);
    }
}
