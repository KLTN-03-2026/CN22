<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'progress',
        'started_at',
        'completed_at',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
