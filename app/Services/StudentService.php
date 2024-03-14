<?php
namespace App\Services;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class StudentService
{
    public function getAllStudents($perPage = 10, $sort = [['key' => 'created_at'], ['order' => 'desc']]) : LengthAwarePaginator
    {
        return Student::orderBy(Arr::get($sort, '0.key', 'created_at'), Arr::get($sort, '1.order', 'desc'))->paginate($perPage);
    }

    public function createStudent(Request $request): Student
    {

        $student = new Student();
        
        $student->username = $request->get("username");
        $student->email = $request->get("email");
        $student->save();

        return $student;

    }


    public function deleteStudent($studentId): void
    {
        $student = Student::findOrFail($studentId);
        $student->delete();
    }
}