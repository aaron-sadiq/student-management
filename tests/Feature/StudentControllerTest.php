<?php

namespace Tests\Feature;

use App\Services\StudentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $studentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->studentService = $this->mock(StudentService::class);
    }


    /** @test */
    public function store_creates_student_and_redirects_to_index()
    {
        $data = [
            'username' => 'John Doe',
            'email' => 'john@gmail.com',
        ];

        $this->studentService->shouldReceive('createStudent')->once()->with($data);

        $response = $this->post(route('students.store'), $data);

        $response->assertRedirect(route('students.index'));
    }

    /** @test */
    public function destroy_deletes_student_and_redirects_to_index()
    {
        $studentId = 1;

        $this->studentService->shouldReceive('deleteStudent')->once()->with($studentId);

        $response = $this->delete(route('students.destroy', $studentId));

        $response->assertRedirect(route('students.index'));
    }
}
