<?php

use App\Camera;
use App\Person;
use App\Repositories\PositionReportsRepository;
use Laravel\Lumen\Testing\DatabaseMigrations;

class PositionReportTest extends TestCase
{
    use DatabaseMigrations;

    private $person;
    private $camera;

    public function setUp()
    {
        parent::setUp();

        $this->withoutMiddleware();

        $this->person = factory(Person::class)->create();

        $this->camera = factory(Camera::class)->create();
    }

    /** @test */
    public function a_positive_position_report_can_be_created()
    {
        $repository = Mockery::mock(PositionReportsRepository::class);
        $repository->shouldReceive('success')->once();
        app()->instance(PositionReportsRepository::class, $repository);

        $this->json('POST', route('reports.success'), [
            'person_id'  => $this->person->id,
            'camera_id'  => $this->camera->id,
            'successful' => 1,
        ])->assertResponseStatus(201);
    }

    /** @test */
    public function an_unidentified_position_report_can_be_created()
    {
        $repository = Mockery::mock(PositionReportsRepository::class);
        $repository->shouldReceive('unsuccessful')->once();
        app()->instance(PositionReportsRepository::class, $repository);

        $this->json('POST', route('reports.unsuccessful'), [
            'person_id'  => $this->person->id,
            'camera_id'  => $this->camera->id,
            'successful' => 0,
        ])->assertResponseStatus(201);
    }
}
