<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{
    protected $table = 'test_cases';
    protected $fillable = [
        'exercise_id',
        'input',
        'expected_output',
        'is_hidden',
    ];
}
