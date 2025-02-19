<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'books';
    protected $fillable = [
        'book_code',
        'book_name',
        'book_type',
        'author',
        'quantity',
        'description',
        'book_cover',
    ];
    public function borrows()
    {
        return $this->hasMany(BorrowModel::class, 'book_code', 'book_code');
    }

    public function students()
    {
        return $this->belongsToMany(StudentModel::class, 'borrows', 'book_code', 'student_code');
    }


    public function borrowsNotReturned()
    {
        return $this->hasMany(BorrowModel::class, 'book_code', 'book_code')
            ->where('is_return', false);
    }

    /**
     * Lấy số liệu sách tổng hợp
     */
    public static function getBookStats()
    {
        return (object) [
            'totalBooks'  => self::sum('quantity'),
            'brokenBooks' => self::sum('broken')
        ];
    }

    /**
     * Tính số sách có sẵn (total - broken - borrowed)
     */
    public static function getAvailableBooks()
    {
        $bookStats = self::getBookStats();
        $borrowedBooks = BorrowModel::getBorrowStats()->borrowedBooks ?? 0;

        return max(0, $bookStats->totalBooks - $bookStats->brokenBooks - $borrowedBooks);
    }
}
