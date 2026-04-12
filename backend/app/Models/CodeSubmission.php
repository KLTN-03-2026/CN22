<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'language_id',
        'code',
        'status',
        'score',
        'execution_time',
        'memory_usage',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function language()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
