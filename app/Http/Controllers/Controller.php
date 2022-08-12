<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\StatsRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $userRepo, $questionRepo;
    public function __construct()
    {
        $this->userRepo = new UserRepository();
        $this->questionRepo = new QuestionRepository();
        $this->statsRepo = new StatsRepository();
    }
}
