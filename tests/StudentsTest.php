<?php

use App\Course;
use App\Student;
use Laravel\Lumen\Testing\DatabaseMigrations;

class StudentsTest extends TestCase
{
    use DatabaseMigrations;

    protected $student;

    public function setUp()
    {
        parent::setUp();

        $this->student = factory(Student::class)->create();

        $this->disableMiddleware();
    }

    /** @test */
    public function a_list_of_students_can_be_retrieved()
    {
        $this->json('GET', route('students.index'))->seeJsonStructure(['data' => ['students']]);
    }

    /** @test */
    public function a_student_can_be_retrieved()
    {
        $this->json('GET', route('students.show', ['id' => $this->student->identifier]))
            ->seeJsonStructure(['data' => ['student' => ['course']]]);
    }

    /** @test */
    public function a_student_can_be_created()
    {
        $this->json('POST', route('students.store'), [
            'identifier' => 'n0123456',
            'name_first' => 'Ian',
            'name_last' => 'Ahmed',
            'start_year' => '2017',
            'dob' => '1970-08-21',
            'gender' => 'M',
            'course_id' => factory(Course::class)->create()->id,
        ])->seeHeader('Location')->assertResponseStatus(201);
    }
}
