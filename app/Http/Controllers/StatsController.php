<?php

namespace App\Http\Controllers;

class StatsController extends Controller
{
    public function index()
    {
        $mostQuestions = $this->statsRepo->mostQuestions();
        $mostAnswers = $this->statsRepo->mostAnswers();
        return view('stats')
            ->with('mostQuestions', $mostQuestions)
            ->with('mostAnswers', $mostAnswers);
    }
}
