<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\QuestionsIndexRequest;

class QuestionController extends Controller
{
    public function index(QuestionsIndexRequest $request)
    {
        $questions = $this->questionRepo->all();
        return view('questionsIndex')->with('questions', $questions);
    }

    public function show($questionId, QuestionsIndexRequest $request)
    {
        $question = $this->questionRepo->findById($questionId);
        $answers = $this->questionRepo->questionAnswers($questionId);
        return view('showQuestion')
            ->with('question', $question)
            ->with('answers', $answers);
    }

    public function askQuestion(QuestionRequest $request)
    {
        $question = $this->questionRepo->createQuestion(session('user_id'), $request->body);
        return redirect()->route('questions');
    }

    public function submitAnswer(int $questionId, AnswerRequest $request)
    {
        $answer = $this->questionRepo->createAnswer($questionId, session('user_id'), $request->body);
        return redirect()->route('showQuestion', $questionId);
    }
}
