@extends('layout')
@section('title', 'Question By ' . $question['name'])
@section('content')
<div class="grid grid-cols-1 gap-6">
<h1>Question</h1>
    {{ $question['body'] }}
<h1>Answers</h1>
    <table>
        <tr>
            <th>User Name</th>
            <th>Question</th>
            <th>Answer(s)</th>
        </tr>
        @foreach($answers as $answer)
            <tr>
                <td>
                    {{ $answer['name'] }}
                </td>
                <td>
                    {{ $answer['body'] }}
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
<form method="POST" action="{{ route('submitAnswer', $question['id']) }}">
    @csrf
    <label for="body">Answer</label>
    <br>
    <textarea type="textarea" id="body" name="body" placeholder="Enter your answer"></textarea>
    <br><br>
    <input type="submit" value="Submit Answer" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
</form>
</div>
@endsection
