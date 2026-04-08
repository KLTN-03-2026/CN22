<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
    ];

    const TYPE_MULTIPLE_CHOICE = 1;
    const TYPE_SHORT_ANSWER = 2;

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
