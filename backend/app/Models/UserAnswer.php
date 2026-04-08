<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
    protected $fillable = [
        'quiz_result_id',
        'question_id',
        'selected_answer_id',
        'is_correct',
        'score',
    ];

    public function quizResult()
    {
        return $this->belongsTo(QuizResult::class, 'quiz_result_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function selectedAnswer()
    {
        return $this->belongsTo(Answer::class, 'selected_answer_id');
    }
}
