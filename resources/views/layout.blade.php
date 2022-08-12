<head>
@vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-black to-blue-500">
<div class="hero h-3 bg-white  mb-5">
    <div class="hero-body">
        <div class="grid grid-cols-3 gap-4 w-full">
            <div>
                @if ((bool) session('user_id'))
                    <a href="{{ route('questions') }}">Home</a>
                @endif
            </div>
            <div>
                @yield('title')
            </div>
            <div>
                @if ((bool) session('user_id'))
                    <a href="{{ route('logout') }}">Log Out</a>
                @endif
            </div>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="bg-yellow-300 border:1px red; rounded-md w-3/6 mx-auto p-8 shadow-lg">
        <ul>
            @foreach ($errors->all() as $field => $error)
                <li>You must fill out all required fields.</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif
<div class="w-3/6 container mx-auto bg-white rounded-md shadow-lg p-8">
    @yield('content')
</div>
</body>
