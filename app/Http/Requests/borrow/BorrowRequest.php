<?php

namespace App\Http\Requests\borrow;

use App\Rules\NotBanned;
use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'book_code'      => ['required', 'exists:books,book_code'],
            'student_code'   => ['required', 'exists:students,student_code',  new NotBanned()],
            'quantity'       => ['required', 'integer', 'min:1'],
            'borrow_date'    => 'required|date',
            'return_date'    => 'required|date|after:borrow_date',

        ];
    }

    public function messages()
    {
        return [
            'book_code.required' => 'Mã sách không được để trống.',
            'book_code.exists'   => 'Mã sách không tồn tại trong hệ thống.',
            'student_code.required' => 'Mã sinh viên không được để trống.',
            'student_code.exists'   => 'Mã sinh viên không tồn tại trong hệ thống.',
            'quantity.required'  => 'Số lượng mượn không được để trống.',
            'quantity.integer'   => 'Số lượng mượn phải là số nguyên.',
            'quantity.min'       => 'Số lượng mượn không được dưới 1.',
            'borrow_date.required'  => 'Ngày mượn không được để trống.',
            'borrow_date.date'      => 'Ngày mượn không hợp lệ.',
            'return_date.required'  => 'Ngày trả không được để trống.',
            'return_date.date'      => 'Ngày trả không hợp lệ.',
            'return_date.after'     => 'Ngày trả phải sau ngày mượn.',
        ];
    }
}
