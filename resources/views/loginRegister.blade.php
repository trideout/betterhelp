@extends('layout')
@section('title', 'Login / Register')
@section('content')
<br>
<div class="grid grid-cols-1 gap-6">
    <form method="POST">
        @csrf
        <label for="name">User Name</label>
        <br>
        <input type="text" id="name" name="name" placeholder="Enter your name">
        <br><br>
        <input type="submit" value="Login/Register" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
    </form>
</div>
@endsection
