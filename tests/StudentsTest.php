<?php

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
        $this->json('GET', route('students.index'))->seeJsonStructure(['data' => ['students' => ['course']]])->assertResponseOk();
    }
}
