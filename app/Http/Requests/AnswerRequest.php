<?php

namespace App\Http\Requests;

use App\Repositories\QuestionRepository;
use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $questionRepo = new QuestionRepository();
        $question = $questionRepo->findById($this->route('id'));
        return (bool) session('user_id') && $question['author_id'] != session('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body' => [
                'required',
                'unique:answers,body'
            ],
        ];
    }
}
