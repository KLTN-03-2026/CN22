<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    protected $table = 'lesson_progress';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'status',
        'completed_at',
    ];

    const NOT_STARTED = 0;
    const IN_PROGRESS = 1;
    const COMPLETED = 2;
    
    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Lesson
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
