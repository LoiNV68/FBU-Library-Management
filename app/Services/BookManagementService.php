<?php

namespace App\Services;

use App\Models\BookModel;

class BookManagementService
{
    public function getAllBooks()
    {
        // Fetch books from the database
        $books = BookModel::select(
            'id',
            'book_cover',
            'book_code',
            'book_name',
            'book_type',
            'author',
            'quantity',
            'broken',
            'description'
        )->orderBy('created_at', 'desc')->paginate(10);

        // Calculate availableBooks after fetching
        $books->each(function ($book) {
            $book->availableBooks = max(0, $book->quantity - $book->broken); // Calculate available books
        });

        return $books;
    }
}
