<?php

namespace App\Services;

use App\Models\BookModel;
use App\Models\StudentModel;

class ReaderManagementService
{
    public function getReaders()
    {
        // Fetch books from the database
        $readers = StudentModel::select(
            'id',
            'student_code',
            'student_name',
            'institute',
            'class',
            'school_year',
            'ban'
        )->orderBy('created_at', 'desc')->paginate(10);

        return $readers;
    }
}
