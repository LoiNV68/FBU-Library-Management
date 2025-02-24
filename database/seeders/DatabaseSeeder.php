<?php

namespace Database\Seeders;

use App\Models\BookModel;
use App\Models\BorrowModel;
use App\Models\StudentModel;
use App\Models\User;
use App\Models\UserModel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Tạo 10 sinh viên mẫu
        StudentModel::factory()->count(500)->create();

        // Tạo 20 sách mẫu
        BookModel::factory()->count(200)->create();

        // Tạo 15 mượn sách mẫu
        BorrowModel::factory()->count(500)->create();

        UserModel::factory()->count(1)->create();
    }
}
