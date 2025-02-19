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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('book_code');      // Mã sách mượn (có thể thiết lập ràng buộc khóa ngoại nếu cần)
            $table->string('student_code');   // Mã sinh viên mượn sách
            $table->integer('quantity_borrow');  // Số lượng sách mượn
            $table->date('borrow_day');          // Ngày mượn
            $table->date('return_day');          // Ngày dự kiến trả
            // Nếu overdue là kiểu boolean: 
            $table->boolean('overdue')->default(false); // Cờ quá hạn (false: chưa quá hạn, true: đã quá hạn)
            // Nếu muốn lưu số ngày quá hạn thay vì boolean, sử dụng kiểu integer (ví dụ: $table->integer('overdue')->default(0);)
            $table->text('description')->nullable(); // Ghi chú
            $table->boolean('is_return')->default(false); // Cờ đã trả (false: chưa trả, true: đã trả)
            $table->timestamps();

            $table->foreign('book_code')->references('book_code')->on('books')->onDelete('cascade');
            $table->foreign('student_code')->references('student_code')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
