<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // hoặc tùy theo quyền của bạn
    }

    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'content'           => 'required|string',
            'order'             => 'nullable|integer|min:1',
            'video_url'         => 'nullable',
            'score_requirement' => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'Vui lòng nhập tiêu đề bài học.',
            'title.string'      => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max'         => 'Tiêu đề không vượt quá 255 ký tự.',
            'content.required'  => 'Vui lòng chọn loại nội dung.',
            'content.string'    => 'Loại nội dung phải là chuỗi ký tự.',
            'order.integer'     => 'Thứ tự phải là số nguyên.',
            'order.min'         => 'Thứ tự phải lớn hơn hoặc bằng 1.',
            'score_requirement.integer' => 'Yêu cầu điểm phải là số.',
            'score_requirement.min'     => 'Yêu cầu điểm không thể âm.',
        ];
    }
}
