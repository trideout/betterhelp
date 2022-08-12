<?php

namespace Tests\Feature;

use App\Repositories\QuestionRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testUserMustBeLoggedIn()
    {
        $this->post(route('askQuestion'), [
            'body' => $this->faker->paragraph()
        ])->assertForbidden();
    }

    public function testUserCanCreateQuestion()
    {
        $userRepo = new UserRepository();
        $user = $userRepo->create($this->faker->firstName);
        $body = $this->faker->paragraph();
        $this->withSession(['user_id' => $user['id']])->post(route('askQuestion'), [
            'body' => $body,
        ])->assertRedirect();
        $this->assertDatabaseHas('questions', [
            'author_id' => $user['id'],
            'body' => $body,
        ]);
    }

    public function testUserCanCreateAnswer()
    {
        $userRepo = new UserRepository();
        $questionRepo = new QuestionRepository();
        $user = $userRepo->create($this->faker->firstName);
        $answerUser = $userRepo->create($this->faker->firstName);
        $question = $questionRepo->createQuestion($user['id'], $this->faker->paragraph());
        $answerBody = $this->faker->paragraph();
        $this->withSession(['user_id' => $answerUser['id']])->post(route('submitAnswer', $question['id']), [
            'body' => $answerBody,
        ])->assertRedirect(route('showQuestion', $question['id']));
        $this->assertDatabaseHas('answers', [
            'question_id' => $question['id'],
            'author_id' => $answerUser['id'],
            'body' => $answerBody,
        ]);
    }

    public function testUserCanNotAnswerTheirOwnQuestion()
    {
        $userRepo = new UserRepository();
        $questionRepo = new QuestionRepository();
        $user = $userRepo->create($this->faker->firstName);
        $question = $questionRepo->createQuestion($user['id'], $this->faker->paragraph());
        $answerBody = $this->faker->paragraph();
        $this->withSession(['user_id' => $user['id']])->post(route('submitAnswer', $question['id']), [
            'body' => $answerBody,
        ])->assertForbidden();
    }
}
