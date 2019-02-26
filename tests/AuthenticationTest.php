<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create(
            ['password' => Hash::make('secret')]
        );
    }

    /** @test */
    public function a_user_can_login()
    {
        $this->json('POST', route('login'), [
            'username' => $this->user->username,
            'password' => 'secret',
        ])->assertResponseOk();
    }

    /** @test */
    public function a_user_cannot_authenticate_with_incorrect_password()
    {
        $this->json('POST', route('login'), [
            'username' => $this->user->username,
            'password' => 'not-the-correct-password',
        ])->assertResponseStatus(400);
    }

    /** @test */
    public function a_user_cannot_authenticate_when_no_username_found()
    {
        $this->json('POST', route('login'), [
            'username' => 'not-the-correct-username',
            'password' => 'secret',
        ])->seeJson(['error' => 'User not found.']);
    }

    /** @test */
    public function a_user_must_provide_a_username_and_password()
    {
        $this->json('POST', route('login'), [
            'password' => 'secret',
        ])->assertResponseStatus(422);

        $this->json('POST', route('login'), [
            'username' => 'secret',
        ])->assertResponseStatus(422);
    }
}