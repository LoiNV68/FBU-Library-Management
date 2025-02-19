<?php

namespace App\Services;

use App\Models\BookModel;
use App\Models\BorrowModel;
use App\Models\StudentModel;

class LibraryStatisticsService
{
    public function getStatistics()
    {
        // Lấy số liệu từ BookModel
        $bookStats = BookModel::getBookStats();
        $totalBooks = $bookStats->totalBooks ?? 0;
        $brokenBooks = $bookStats->brokenBooks ?? 0;

        // Lấy số liệu từ BorrowModel
        $borrowStats = BorrowModel::getBorrowStats();
        $borrowedBooks = $borrowStats->borrowedBooks ?? 0;
        $returnedBooks = $borrowStats->returnedBooks ?? 0;
        $overdueBooks = $borrowStats->overdueBooks ?? 0;

        // Tính sách có sẵn từ BookModel
        $availableBooks = BookModel::getAvailableBooks();

        // Lấy số liệu từ StudentModel
        $totalReaders = StudentModel::count();
        $borrowedReaders = BorrowModel::getBorrowedReadersCount();
        $newReaders = BorrowModel::getNewReadersCount();
        $banedReaders = StudentModel::getViolatedReadersCount();

        return [
            'totalBooks'      => $totalBooks,
            'brokenBooks'     => $brokenBooks,
            'borrowedBooks'   => $borrowedBooks,
            'returnedBooks'   => $returnedBooks,
            'overdueBooks'    => $overdueBooks,
            'availableBooks'  => $availableBooks,
            'totalReaders'    => $totalReaders,
            'borrowedReaders' => $borrowedReaders,
            'newReaders'      => $newReaders,
            'banedReaders'    => $banedReaders,
        ];
    }
}
