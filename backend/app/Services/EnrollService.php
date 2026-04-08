<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\EnrollRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ProgressRepository;
use App\Repositories\CourseRepository;

class EnrollService
{
    protected $enrollRepo;
    protected $lessonRepo;
    protected $progressRepo;
    protected $courseRepo;


    public function __construct(EnrollRepository $enrollRepo, LessonRepository $lessonRepo, ProgressRepository $progressRepo, CourseRepository $courseRepo)
    {
        $this->enrollRepo = $enrollRepo;
        $this->lessonRepo = $lessonRepo;
        $this->progressRepo = $progressRepo;
        $this->courseRepo = $courseRepo;
    }

    public function enrollCourse($courseId, $user)
    {

        // ===== 1. Check đã đăng ký chưa =====
        $exists = $this->enrollRepo->checkEnrollment($courseId, $user->id);

        if ($exists) {
            return [
                'message' => 'Bạn đã đăng ký khóa học này rồi',
                'is_registered' => true
            ];
        }

        // ===== 2. Check course tồn tại =====
        $course = $this->courseRepo->findById($courseId);
        if (!$course) {
            return [
                'message' => 'Khóa học không tồn tại'
            ];
        }

        // ===== 3. ENROLL (BỎ QUA PAYMENT) =====

        $check = $this->enrollRepo->enrollCourse($courseId, $user->id);

        return [
            'message' => 'Đăng ký khóa học thành công',
            'is_registered' => true
        ];



        /*
        ==============================
        TODO: SEPAY PAYMENT (TƯƠNG LAI)
        ==============================
        - Nếu course có price > 0
        - Tạo order
        - Gọi SePay API
        - Sau khi thanh toán → tạo enrollment
        */
    }
}
