<?php

namespace Database\Factories;

use App\Models\BookModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookModelFactory extends Factory
{
    protected $model = BookModel::class;

    public function definition()
    {
        return [
            'book_code'  => $this->faker->unique()->bothify('BK####'),
            'book_name'  => $this->faker->sentence(3),
            'book_type'  => $this->faker->randomElement(['Giáo trình', 'Tiểu luận', 'Đồ án', 'Luận án', 'Luận văn', 'Bài tập lớn']),
            'author'     => $this->faker->name(),
            'quantity'   => $this->faker->numberBetween(10, 100),
            'broken'     => $this->faker->numberBetween(0, 10), 
            'description' => $this->faker->boolean(70) ? $this->faker->paragraph() : null, // 70% có mô tả
            'book_cover'  => $this->faker->imageUrl(200, 300, 'books', true), // Không cần `optional()`
        ];
    }
}
