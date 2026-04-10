<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChapterService;
use Illuminate\Http\Request;

class ADChapterController extends Controller
{
    protected $chapterService;

    public function __construct(ChapterService $chapterService)
    {
        $this->chapterService = $chapterService;
    }

    public function index(Request $request)
    {
        return $this->chapterService->getByCourse($request->course_id);
    }

    public function store(Request $request)
    {
        return $this->chapterService->create($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->chapterService->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->chapterService->delete($id);
    }
}
