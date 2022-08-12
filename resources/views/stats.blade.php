@extends('layout')
@section('title', 'Stats')
@section('content')
<div class="grid grid-cols-1 gap-6">
    <h1>Most Questions Asked</h1>
    <div>{{ $mostQuestions['name'] }} with a total of {{$mostQuestions['questionCount']}} question{{ $mostQuestions['questionCount'] == 1 ? '' : 's' }}!</div>
</div>
<div class="grid grid-cols-1 gap-6">
    <h1>Most Questions Answered</h1>
    <div>{{ $mostAnswers['name'] }} with a total of {{$mostAnswers['answerCount']}} question{{ $mostAnswers['answerCount'] == 1? '' : 's'}} answered!</div>
</div>
@endsection
