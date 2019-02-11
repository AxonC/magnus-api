<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Camera;

class CameraMiddlewareTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function a_camera_can_be_used_for_authentication()
    {
        $camera = factory(Camera::class)->create();

        $this->json('GET', route('camera.show', ['id' => $camera->id]), [],
            ['Token' => $camera->token, 'Address' => $camera->camera_address])->assertResponseOk();
    }
}