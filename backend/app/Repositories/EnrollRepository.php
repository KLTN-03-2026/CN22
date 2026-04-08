<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class EnrollRepository
{
    public function checkEnrollment($courseId, $userId)
    {
        return DB::table('enrollments')
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();
    }

    public function enrollCourse($courseId, $userId)
    {
        DB::table('enrollments')->insert([
            'user_id' => $userId,
            'course_id' => $courseId,
            'progress' => 0,
            'enrolled_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
