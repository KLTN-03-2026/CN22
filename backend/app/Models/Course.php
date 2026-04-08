<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'status',
        'price',
    ];


    const ACTIVE = 1;
    const INACTIVE = 0;

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id');
    }

    protected static function booted()
    {
        static::deleting(function ($course) {
            $course->chapters->each(function ($chapter) {
                $chapter->delete(); // kích hoạt Model Event của chapter để xóa Lesson
            });
        });
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class, 'course_id', 'chapter_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_users', 'course_id', 'user_id');
    }
}
