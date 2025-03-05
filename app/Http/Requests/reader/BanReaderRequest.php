<?php

namespace App\Http\Requests\reader;

use Illuminate\Foundation\Http\FormRequest;

class BanReaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_code' => 'required|string|exists:students,student_code',
            'action' => 'required|in:ban,unban'
        ];
    }

    public function messages()
    {
        return [
            'student_code.required' => 'Mã sinh viên không được để trống.',
            'student_code.exists' => 'Mã sinh viên không tồn tại.',
            'action.required' => 'Hành động không hợp lệ.',
            'action.in' => 'Hành động chỉ có thể là ban hoặc unban.'
        ];
    }
}
