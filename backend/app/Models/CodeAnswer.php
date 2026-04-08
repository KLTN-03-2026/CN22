<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeAnswer extends Model
{
    protected $table = 'code_answers';
    protected $fillable = [
        'question_id',
        'description',
        'input_format',
        'output_format',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
