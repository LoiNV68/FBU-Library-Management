<?php

namespace Database\Factories;

use App\Models\BorrowModel;
use App\Models\BookModel;
use App\Models\StudentModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowModelFactory extends Factory
{
    protected $model = BorrowModel::class;

    public function definition()
    {
        // Lấy ngẫu nhiên book_code từ bảng books (BookModel), nếu chưa có thì tạo giá trị giả định
        $bookCode = BookModel::inRandomOrder()->value('book_code') ?? $this->faker->bothify('BK####');
        // Lấy ngẫu nhiên student_code từ bảng students (StudentModel), nếu chưa có thì tạo giá trị giả định
        $studentCode = StudentModel::inRandomOrder()->value('student_code') ?? $this->faker->bothify('STU####');

        // Tạo ngày mượn ngẫu nhiên trong khoảng 1 tháng trước đến hiện tại
        $borrowDay = $this->faker->dateTimeBetween('-1 month', 'now');
        // Ngày trả: giả sử gia hạn mượn trong vòng 1 năm (có thể thay đổi theo yêu cầu)
        $returnDay = Carbon::instance($borrowDay)->addYear(1);

        return [
            'book_code'       => $bookCode,
            'student_code'    => $studentCode,
            'quantity_borrow' => $this->faker->numberBetween(1, 5),
            'borrow_day'      => $borrowDay->format('Y-m-d'),
            'return_day'      => $returnDay->format('Y-m-d'),
            'overdue'         => $this->faker->boolean(),
            'description'     => $this->faker->optional()->sentence,
            'is_return'       => $this->faker->boolean(),
        ];
    }
}
