<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionResult extends Model
{
    protected $fillable = [
        'submission_id',
        'testcase_id',
        'passed',
        'actual_output',
        'error_message',
    ];

    public function submit()
    {
        return $this->belongsTo(CodeSubmission::class, 'submission_id');
    }

    public function testcase()
    {
        return $this->belongsTo(TestCase::class, 'testcase_id');
    }
}
