<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Student;
use App\Models\StudentModel;

class NotBanned implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $student = StudentModel::where('student_code', $value)->first();

        if ($student && $student->ban == 1) {
            $fail('Sinh viên đang bị cấm mượn.');
        }
    }
}
