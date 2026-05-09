<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'order'         => 'nullable|integer|min:1',
            'is_free'       => 'required|boolean',
            'price'         => 'nullable|numeric|min:0',
            'status'        => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Vui lòng nhập tiêu đề chương.',
            'title.string'          => 'Tiêu đề phải là chuỗi ký tự.',
            'title.max'             => 'Tiêu đề không được vượt quá 255 ký tự.',
            'description.string'    => 'Mô tả phải là chuỗi ký tự.',
            'order.integer'         => 'Thứ tự phải là số nguyên.',
            'order.min'             => 'Thứ tự phải lớn hơn hoặc bằng 1.',
            'is_free.required'      => 'Vui lòng xác định xem chương có miễn phí hay không.',
            'is_free.boolean'       => 'Giá trị của miễn phí phải là đúng hoặc sai.',
            'price.numeric'         => 'Giá phải là số.',
            'price.min'             => 'Giá không thể âm.',
            'status.in'             => 'Trạng thái không hợp lệ.',
        ];
    }
}
