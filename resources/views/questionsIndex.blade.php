@extends('layout')
@section('title', 'All Questions')
@section('content')
<div class="grid grid-cols-1 gap-6">
<table>
    <tr>
        <th>User Name</th>
        <th>Question</th>
        <th>Answer(s)</th>
    </tr>
    @foreach($questions as $question)
        <tr>
            <td>
                <a href="{{ route('showQuestion', $question['id']) }}">
                    {{ $question['name'] }}
                </a>
            </td>
            <td>
                <a href="{{ route('showQuestion', $question['id']) }}">
                    {{ Str::limit($question['body'], 50, '....') }}
                </a>
            </td>
            <td>
                {{ $question['answer_count']}}
            </td>
        </tr>
    @endforeach
</table>
<hr>
<form method="POST" action="{{ route('askQuestion') }}">
    @csrf
    <label for="body">Question</label> <br>
    <textarea type="textarea" id="body" name="body" placeholder="Enter your question"></textarea>
    <br><br>
    <input type="submit" value="Submit New Question" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
</form>
</div>
@endsection
