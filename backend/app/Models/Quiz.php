<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = [
        'title',
        'course_id',
        'lesson_id',
        'time_limit',
        'total_score',
        'pass_score',
        'max_times',
        'shuffle_questions',
        'is_active',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
    
}
