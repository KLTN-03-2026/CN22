<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
    protected $fillable = [
        'result_id',
        'question_id',
        'answer_id',
        'is_correct',
        'score',
    ];

    public function quizResult()
    {
        return $this->belongsTo(QuizResult::class, 'result_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
