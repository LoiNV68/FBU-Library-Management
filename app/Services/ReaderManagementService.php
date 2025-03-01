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

    public function searchReaders($query)
    {
        return StudentModel::whereRaw('LOWER(student_name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(student_code) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(institute) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(class) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(school_year) LIKE ?', ['%' . strtolower($query) . '%'])
            ->orWhereRaw('LOWER(ban) LIKE ?', ['%' . strtolower($query) . '%'])
            ->paginate(10)
            ->appends(['query' => $query]);
    }

    public function banReader(array $data)
    {
        $student = StudentModel::where('student_code', $data['student_code'])->firstOrFail();

        $student->ban = $data['action'] === 'ban' ? 1 : 0;
        $student->save();
        return [
            'type' => 'success',
            'message' => $data['action'] === 'ban' ? 'Cấm bạn đọc thành công!' : 'Gỡ cấm bạn đọc thành công!'
        ];
    }

    public function checkBanStatus($student_code)
    {
        $student = StudentModel::where('student_code', $student_code)->first();

        if (!$student) {
            return ['error' => 'Sinh viên không tồn tại'];
        }

        return ['ban' => $student->ban];
    }
}
