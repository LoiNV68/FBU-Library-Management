<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'borrows';
    protected $fillable = [
        'book_code',
        'student_code',
        'quantity_borrow',
        'borrow_day',
        'return_day',
        'overdue',
        'description',
        'is_return',
    ];

    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_code', 'student_code');
    }

    public function book()
    {
        return $this->belongsTo(BookModel::class, 'book_code', 'book_code');
    }

    public static function getBorrowStats()
    {
        return self::selectRaw(
            'SUM(CASE WHEN is_return = 0 THEN quantity_borrow ELSE 0 END) AS borrowedBooks,
             SUM(CASE WHEN is_return = 1 THEN quantity_borrow ELSE 0 END) AS returnedBooks,
             SUM(CASE WHEN is_return = 0 AND return_day < ? THEN quantity_borrow ELSE 0 END) AS overdueBooks',
            [Carbon::now()]
        )->first();
    }

    public static function getBorrowedReadersCount()
    {
        return self::where('is_return', false)->distinct('student_code')->count('student_code');
    }


    public static function getNewReadersCount()
    {
        return self::whereMonth('borrow_day', now()->month)
            ->distinct('student_code')
            ->count('student_code');
    }
}
