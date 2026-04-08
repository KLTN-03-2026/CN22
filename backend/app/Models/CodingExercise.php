<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodingExercise extends Model
{
    protected $table = 'coding_exercises';
    protected $fillable = [
        'topic_id',
        'title',
        'description',
        'starter_code',
        'solution_code',
        'difficulty',
    ];
}
