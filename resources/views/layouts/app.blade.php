<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<!-- Scripts -->
</head>
<body>
<div id="app">

    @if(session('success') || session('fail'))
        <div class="alert {{ session('fail') ? 'alert-danger' : 'alert-success' }}" id="flash-message">
            {{ session('success') }} {{ session('fail') }}
        </div>
    @endif
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm px-3">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{URL::asset('/img/logo.jpg')}}" alt="Flux" style="width: 100px;">
            </a>
{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
                @auth
                    <ul class="navbar-nav bd-navbar-nav flex-row">
                        <li class="nav-item">
                            <a class="nav-link px-2" href="{{ route('bots.index') }}">
                                Bots
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="{{ route('exchanges.index') }}">
                                Exchanges
                            </a>
                        </li>
                        <li>
                            <a class="nav-link px-2" href="{{ route('deals.index') }}">
                                Deals
                            </a>
                        </li>
                    </ul>
                @endauth

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
<script type="module">
    $(document).ready(function() {
        if ($('#flash-message').length) {
            setTimeout(function() {
                $('#flash-message').fadeOut('slow');
            }, 1000);
        }
    });
</script>
</body>
</html>
