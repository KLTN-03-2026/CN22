<?php

namespace App\Services;

use App\Models\Chapter;

class ChapterService
{
    public function getByCourse($courseId)
    {
        return Chapter::where('course_id', $courseId)
            ->orderBy('order')
            ->get();
    }

    public function create($data)
    {
        return Chapter::create($data);
    }

    public function update($id, $data)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update($data);
        return $chapter;
    }

    public function delete($id)
    {
        return Chapter::destroy($id);
    }
}
