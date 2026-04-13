<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = 'chapters';
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
        'is_free',
        'price',
        'status',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'chapter_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function userChapters()
    {
        return $this->hasMany(UserChapter::class);
    }


    protected static function booted()
    {
        static::deleting(function ($chapter) {
            $chapter->lessons()->delete();
        });
    }
}
