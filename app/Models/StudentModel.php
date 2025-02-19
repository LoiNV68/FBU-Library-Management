<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'students';
    protected $fillable = [
        'student_code',
        'student_name',
        'institute',
        'class',
        'school_year',
    ];

    public function borrows()
    {
        return $this->hasMany(BorrowModel::class, 'student_code', 'student_code');
    }
    public function books()
    {
        return $this->belongsToMany(BookModel::class, 'borrows', 'student_code', 'book_code');
    }

    public static function getViolatedReadersCount()
    {
        return self::where('ban', true)->distinct('student_code')->count('student_code');
    }
}
