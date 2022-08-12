<?php

namespace App\Repositories;

use PDO;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    public function findById(int $id): ?array
    {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id=:id ORDER BY created_at DESC');
        $query->execute([
            'id' => $id,
        ]);
        return $this->fetchSingle($query);
    }

    public function findByName(string $name): ?array
    {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE name=:name ORDER BY created_at DESC');
        $query->execute([
            'name' => $name,
        ]);
        return $this->fetchSingle($query);
    }

    public function create(string $name): array
    {
        $query = $this->pdo->prepare('INSERT INTO users (name, created_at) VALUES (:name, now())');
        $query->execute([
            'name' => $name,
        ]);
        return $this->findByName($name);
    }
}
