<?php

namespace App\Repositories;

use PDO;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends BaseRepository
{
    public function all(): array
    {
        $query = $this->pdo->prepare('SELECT questions.id, questions.body, users.name, count(answers.id) as answer_count FROM questions LEFT JOIN answers ON questions.id = answers.question_id JOIN users ON users.id=questions.author_id GROUP BY questions.id ORDER BY answer_count DESC, questions.created_at DESC');
        $query->execute();
        return $this->fetchMultiple($query);
    }

    public function findById(int $id): ?array
    {
        $query = $this->pdo->prepare('SELECT questions.id, questions.body, questions.author_id, users.name FROM questions JOIN users ON users.id=questions.author_id WHERE questions.id=:id ORDER BY questions.created_at DESC');
        $query->execute([
            'id' => $id,
        ]);
        return $this->fetchSingle($query);
    }

    public function findAnswerById(int $id): ?array
    {
        $query = $this->pdo->prepare('SELECT * FROM answers WHERE id=:id ORDER BY created_at DESC');
        $query->execute([
            'id' => $id,
        ]);
        return $this->fetchSingle($query);
    }

    public function createQuestion(int $authorId, string $body): array
    {
        $query = $this->pdo->prepare('INSERT INTO questions (author_id, body, created_at) VALUES (:authorId, :body, now())');
        $query->execute([
            'authorId' => $authorId,
            'body' => $body,
        ]);
        return $this->findById($this->pdo->lastInsertId());
    }

    public function createAnswer(int $questionId, int $authorId, string $body)
    {
        $query = $this->pdo->prepare('INSERT INTO answers (question_id, author_id, body, created_at) VALUES (:questionId, :authorId, :body, now())');
        $query->execute([
            'questionId' => $questionId,
            'authorId' => $authorId,
            'body' => $body,
        ]);
        return $this->findAnswerById($this->pdo->lastInsertId());
    }

    public function questionAnswers(int $questionId): array
    {
        $query = $this->pdo->prepare('SELECT answers.id, answers.body, users.name FROM answers JOIN users ON users.id=answers.author_id JOIN questions ON questions.id=answers.question_id WHERE questions.id=:questionId ORDER BY answers.created_at');
        $query->execute([
            'questionId' => $questionId,
        ]);
        return $this->fetchMultiple($query);
    }
}
