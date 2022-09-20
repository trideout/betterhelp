<?php

namespace App\Repositories;

class StatsRepository extends BaseRepository
{
    public function mostQuestions()
    {
        $query = $this->pdo->prepare('SELECT users.name, count(questions.id) as questionCount
            FROM users JOIN questions ON users.id=questions.author_id
            GROUP BY users.id ORDER BY questionCount DESC');
        $query->execute();
        return $this->fetchSingle($query);
    }

    public function mostAnswers()
    {
        $query = $this->pdo->prepare('SELECT users.name, count(DISTINCT answers.question_id) as answerCount
            FROM users JOIN answers ON users.id=answers.author_id
            GROUP BY users.id ORDER BY answerCount DESC');
        $query->execute();
        return $this->fetchSingle($query);
    }
}
