<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        body {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark d-flex justify-center flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 d-none d-md-block ms-2" href="{{ route('user.dashboard') }}">Bool-B&B</a>
        <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3 ml-auto">
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form class="ml-auto" id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-secondary p-1 d-block d-md-none">
            <a class="nav-link text-info" href="{{ url('/') }}">
                Home
            </a>
        </div>
        <div class="bg-secondary p-1 d-block d-md-none">
            <a class="nav-link text-info" href="{{ route('user.dashboard') }}">
                Dashboard
            </a>
        </div>
        <div class="bg-secondary p-1 d-block d-md-none">
            <a class="nav-link text-info" href="{{ route('user.apartment.index') }}">
                I tuoi appartamenti
            </a>
        </div>
        <div class="bg-secondary p-1 d-block d-md-none">
            <a class="nav-link text-info" href="{{ route('user.apartment.create') }}">
                Nuovo appartamento
            </a>
        </div>
        <div class="bg-secondary p-1 d-block d-md-none">
            <a class="nav-link text-info" href="{{ route('user.message.index') }}">
                Messaggi ricevuti
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-lg-1 col-md-2 d-none d-md-block">
                <div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ url('/') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ route('user.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ route('user.apartment.index') }}">
                                I tuoi appartamenti
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ route('user.apartment.create') }}">
                                Nuovo appartamento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ route('user.message.index') }}">
                                Messaggi ricevuti
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-lg-11 col-md-10">
                @yield('content')
            </main>
            
        </div>
    </div>
    @stack('script')
</body>
</html>