<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <!-- Images -->
    <link rel="icon" href="{{ asset('img/scorpio.ico') }}" type="image/x-icon" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />
    @stack('styles')
</head>

<body class="bg-gray-200">
    <!-- Content -->
    <!-- Navbar -->
    <nav class="p-5 bg-white flex justify-between mb-5">
        <ul class="flex items-center">
            <li>
                <a href="#" class="p-3">Home</a>
            </li>

            <li>
                <a href="{{ url('dashboard') }}" class="p-3">Dashboard</a>
            </li>

            @auth
            <li>
                <a href="#" class="p-3">Trips</a>
            </li>
            @endauth
        </ul>

        <ul class="flex items-center">

            @auth
            <li>
                <a href="#" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
            @endauth

            @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}" class="p-3">Register</a>
            </li>
            @endguest

        </ul>
    </nav>
    @yield('content')

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>