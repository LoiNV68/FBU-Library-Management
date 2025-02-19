<?php

namespace Database\Factories;

use App\Models\StudentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentModelFactory extends Factory
{
    protected $model = StudentModel::class;

    public function definition()
    {
        // Tạo student_code bắt đầu bằng "2254800" và thêm 3 chữ số ngẫu nhiên
        $studentCode = '2254800' . $this->faker->unique()->numberBetween(100, 999);

        // Danh sách ngành học và quy tắc mã lớp tương ứng
        $institutes = [
            'Công nghệ thông tin'   => 'D.11.48.' . $this->faker->numberBetween(1, 4),
            'Tài chính – Ngân hàng'  => 'D.34.02.' . $this->faker->numberBetween(1, 9),
            'Ngôn Ngữ Nước Ngoài'    => 'D.22.02.' . $this->faker->numberBetween(1, 9),
            'Pháp luật kinh tế'      => 'D.38.01.' . $this->faker->numberBetween(1, 9),
            'Kế toán – Kiểm toán'     => 'D.34.03.' . $this->faker->numberBetween(1, 9),
            'Quốc tế'               => 'D.99.99.' . $this->faker->numberBetween(1, 9),
        ];

        // Chọn ngẫu nhiên ngành học và mã lớp tương ứng
        $institute = $this->faker->randomElement(array_keys($institutes));
        $class = $institutes[$institute];

        return [
            'student_code' => $studentCode,
            'student_name' => $this->faker->name,
            'institute'    => $institute,
            'class'        => $class,
            'school_year'  => $this->faker->numberBetween(9, 13), // Giả sử năm học từ 9 đến 13
            'ban' => $this->faker->boolean(10)
        ];
    }
}
