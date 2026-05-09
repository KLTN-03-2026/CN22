<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'sometimes|required|string|max:255',
            'description'   => 'sometimes|required|string',
            'thumbnail'     => 'nullable',
            'status'        => 'sometimes|required|in:0,1',
            'price'         => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Vui lòng nhập tiêu đề khóa học.',
            'title.string'          => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max'             => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description.required'  => 'Vui lòng nhập mô tả cho khóa học.',
            'description.string'    => 'Mô tả phải là chuỗi ký tự.',
            'thumbnail.nullable'    => 'Ảnh thu nhỏ không bắt buộc.',
            'status.required'       => 'Vui lòng chọn trạng thái.',
            'status.in'             => 'Trạng thái không hợp lệ.',
            'price.numeric'         => 'Giá phải là số.',
            'price.min'             => 'Giá không thể âm.',
        ];
    }
}
