<?php

use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class UsersAdministrationTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->disableMiddleware();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function all_of_the_admin_users_can_be_retrieved()
    {
        $this->json('GET', route('users.index'))
            ->seeJson()->assertResponseOk();
    }

    /** @test */
    public function an_individual_user_can_be_retrieved()
    {
        $this->json('GET', route('users.show', ['id' => $this->user->id]))
            ->seeJsonStructure(['data' => ['user']]);

        $this->json('GET', route('users.show', ['id' => 0]))
            ->seeJson(['error' => 'User not found.'])->assertResponseStatus(404);
    }

    /** @test */
    public function an_individual_user_can_be_created()
    {
        $this->json('POST', route('users.store'), [
            'username' => 'testusername',
            'email' => 'test@test.com',
            'password' => 'secret'
        ])->seeHeader('Location')->assertResponseStatus(201);

         $this->seeInDatabase('users', [
            'username' => 'testusername',
            'email' => 'test@test.com'
         ]);
    }

    /** @test */
    public function an_individual_user_can_be_updated()
    {
        $this->json('PATCH', route('users.update', ['id' => $this->user->id]), [
            'username' => 'newusername'
        ])->seeJson(['success' => 'User updated.'])->assertResponseOk();
    }
}