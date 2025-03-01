<?php

namespace App\Http\Requests\borrow;

use Illuminate\Foundation\Http\FormRequest;

class ExtendRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'new_due_date'   => ['required', 'date', 'after:today'],
        ];
    }

    public function messages()
    {
        return [
            'new_due_date.required' => 'Ngày gia hạn không được để trống.',
            'new_due_date.date'     => 'Ngày gia hạn phải là ngày hợp lệ.',
            'new_due_date.after'    => 'Ngày gia hạn phải sau hôm nay.',
        ];
    }
}
