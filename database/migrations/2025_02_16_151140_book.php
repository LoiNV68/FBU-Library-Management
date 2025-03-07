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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_code')->unique();
            $table->string('book_name');
            $table->enum('book_type', ['Giáo trình', 'Tiểu luận', 'Đồ án', 'Luận án', 'Luận văn', 'Bài tập lớn']);
            $table->string('author');
            $table->unsignedInteger('quantity'); // Không âm
            $table->unsignedInteger('broken')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('book_cover')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
