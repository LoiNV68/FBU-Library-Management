<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('student_code')->unique(); // Mã sinh viên (duy nhất)
            $table->string('student_name'); // Tên sinh viên
            $table->string('institute'); // Viện đào tạo
            $table->string('class'); // Lớp học
            $table->integer('school_year'); // Năm học (dạng số)
            $table->boolean('ban')->default(false);;
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
