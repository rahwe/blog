<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="{{ mix('css/app.css')}}">
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel Blog</h5>
        <nav class="my-2 my-md-0 mr-md-3">
          
            <a class="p-2 text-dark" href="{{ route('contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>
            {{-- in blade @guest is used to check if your already login or not. if guest show register and 
                login link for them --}}
            @guest
                @if(Route::has('register')) {{-- this mean if in route in web.php has route register we
                show it to let user register by himself --}}
                <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                @endif
                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
            @else {{-- if not guest show logout for user --}}

            <a class="p-2 text-dark" href="{{ route('logout') }}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >Logout({{Auth::user()->name}})</a>

            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">
            @csrf
            
            </form>

            @endguest
        </nav>
    </div>

    <div class="container">
    @if(session()->has('alert'))
        <p>
            {{ session()->get('alert')}}
        </p>

        @endif
        @yield('content')
    </div>

<script src="{{ mix('js/app.js')}}"></script>
</body>
</html>