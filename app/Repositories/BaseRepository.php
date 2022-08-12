<?php

namespace App\Repositories;

use PDO;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = DB::connection()->getPdo();
    }

    protected function fetchSingle($query): ?array
    {
        $response = $query->fetch(PDO::FETCH_ASSOC);
        if (!$response) {
            return null;
        }
        return $response;
    }

    protected function fetchMultiple($query): array
    {
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!$response) {
            return [];
        }
        return $response;
    }
}
