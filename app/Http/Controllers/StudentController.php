<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\StudentService;
use Inertia\Inertia;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $sort = $request->get('sortBy');

        $students = $this->studentService->getAllStudents($perPage, $sort);
        return Inertia::render('Students/Index', [
            'students' => $students->items(),
            'total' => $students->total(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentRequest $request)
    {    
        $this->studentService->createStudent($request);
    
        return redirect()->route('students.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->studentService->deleteStudent($id);
        return redirect()->route('students.index');
    }
}
