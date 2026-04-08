<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CourseRepository
{
    public function findById($id)
    {
        return DB::table('courses')
            ->where('id', $id)
            ->first();
    }

    public function getAll()
    {
        $data = Course::withCount('chapters')
                        ->where('status', Course::ACTIVE)
                        ->get();

        return $data;
    }

    public function findWithRelations($slug)
    {
        $data = Course::with(['chapters.lessons'])->where('slug', $slug)->firstOrFail();
        return $data;
    }

    public function enrolledCourse($courseId, $userId)
    {
        return DB::table('enrollments')
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();
    }

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
            ->where('user_id', $userId)
            ->whereNotNull('chapter_id')
            ->where('status', Order::STATUS_PAID)
            ->pluck('chapter_id')
            ->toArray();
    }
}
