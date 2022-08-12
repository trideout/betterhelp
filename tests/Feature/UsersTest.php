<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\UserRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUserCanLogin()
    {
        $userName = $this->faker->firstName;
        $repo = new UserRepository();
        $repo->create($userName);
        $this->post(route('login'), [
            'name' => $userName,
        ])->assertRedirect(route('questions'));
    }

    public function testNonExistantUserGetsCreated()
    {
        $userName = $this->faker->firstName;
        $this->post(route('login'), [
            'name' => $userName,
        ])->assertRedirect(route('questions'));
        $this->assertDatabaseHas('users', [
            'name' => $userName,
        ]);
    }
}
