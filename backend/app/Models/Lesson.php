<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $fillable = [
        'chapter_id',
        'title',
        'content_type',
        'order',
        'video_url',
        'score_requirement',
    ];

    public function chapters()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, Chapter::class, 'id', 'id', 'chapter_id', 'course_id');
    }
}
