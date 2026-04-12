<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeQuestion extends Model
{
    protected $table = 'coding_questions';
    protected $fillable = [
        'question_id',
        'description',
        'time_limit',
        'memory_limit',
        'sample_input',
        'sample_output'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
