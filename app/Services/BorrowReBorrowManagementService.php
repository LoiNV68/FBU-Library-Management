<?php

namespace App\Services;

use App\Models\BookModel;
use App\Models\BorrowModel;
use App\Models\StudentModel;

class BorrowReBorrowManagementService
{
    public function getAllTransactions()
    {
        return BorrowModel::query()
            ->join('books', 'borrows.book_code', '=', 'books.book_code')
            ->join('students', 'borrows.student_code', '=', 'students.student_code')
            ->select(
                'borrows.return_day',
                'borrows.book_code',
                'borrows.borrow_day',
                'borrows.student_code',
                'borrows.quantity_borrow',
                'borrows.overdue',
                'borrows.is_return',
                'books.book_name',
                'books.book_type',
                'students.student_name'
            )
            ->orderBy('borrows.created_at', 'desc')
            ->paginate(10);
    }
}
