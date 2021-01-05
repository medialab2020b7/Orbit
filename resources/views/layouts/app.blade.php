<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Orbit</title>
    <link rel="icon" type="image/png" href="{{asset("img/logo.png")}}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: "Monument Extended";
            src: url("{{ asset('css/fonts/MonumentExtended-Regular.otf') }}");
        }

        @font-face {
            font-family: "Helvetica LT Ext";
            src: url("{{ asset('css/fonts/HelveticaNeueLTStd-LtEx.otf') }}");
        }

        @media (min-width: 576px) {
            .container {
                max-width: 80vw;
            }
        }
        @media (min-width: 768px) {
            .container {
                max-width: 80vw;
            }
        }
        @media (min-width: 992px) {
            .container {
                max-width: 80vw;
            }
        }
        @media (min-width: 1200px) {
            .container {
                max-width: 80vw;
            }
        }
        body {
            font-family: "Helvetica LT Ext", sans-serif;
            color: white;
            background-color: black;
        }
        h1 {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
        h2 {
            font-size: 1.2rem;
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
        .display-3 {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
        .img-thumbnail {
            border-radius: 0;
        }
        kbd {
            border-radius: 0;
        }
        .form-control {
            color: white;
            background-color: black;
            border-radius: 0;
        }
        .form-control-sm {
            border-radius: 0;
        }
        .form-control-lg {
            border-radius: 0;
        }
        .valid-tooltip {
            border-radius: 0;
        }
        .invalid-tooltip {
            border-radius: 0;
        }
        .btn {
            border-radius: 0;
        }
        .btn-primary:hover {
            color: white;
            background-color: blue;
            border-color: blue;
        }
        .btn-primary:focus, .btn-primary.focus {
            color: white;
            background-color: blue;
            border-color: blue;
            box-shadow: none;
        }
        .btn-primary:active {
            color: white;
            background-color: blue;
            border-color: blue;
        }
        .btn-lg,
        .btn-group-lg > .btn {
            border-radius: 0;
        }
        .btn-sm,
        .btn-group-sm > .btn {
            border-radius: 0;
        }
        .card {
            background-color: transparent;
        }
        .dropdown-menu {
            border-radius: 0;
        }
        .input-group-text {
            border-radius: 0;
        }
        .input-group-lg > .form-control,
        .input-group-lg > .custom-select,
        .input-group-lg > .input-group-prepend > .input-group-text,
        .input-group-lg > .input-group-append > .input-group-text,
        .input-group-lg > .input-group-prepend > .btn,
        .input-group-lg > .input-group-append > .btn {
            border-radius: 0;
        }
        .input-group-sm > .form-control,
        .input-group-sm > .custom-select,
        .input-group-sm > .input-group-prepend > .input-group-text,
        .input-group-sm > .input-group-append > .input-group-text,
        .input-group-sm > .input-group-prepend > .btn,
        .input-group-sm > .input-group-append > .btn {
            border-radius: 0;
        }
        .custom-checkbox .custom-control-label::before {
            border-radius: 0;
        }
        .custom-switch .custom-control-label::before {
            border-radius: 0;
        }
        .custom-switch .custom-control-label::after {
            border-radius: 0;
        }
        .custom-select {
            border-radius: 0;
        }
        .custom-file-label {
            border-radius: 0;
        }
        .custom-file-label::after {
            border-radius: 0;
        }
        .custom-range::-webkit-slider-thumb {
            border-radius: 0;
        }
        .custom-range::-webkit-slider-runnable-track {
            border-radius: 0;
        }
        .custom-range::-moz-range-thumb {
            border-radius: 0;
        }
        .custom-range::-moz-range-track {
            border-radius: 0;
        }
        .custom-range::-ms-thumb {
            border-radius: 0;
        }
        .custom-range::-ms-fill-lower {
            border-radius: 0;
        }
        .navbar {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
        .card {
            border-radius: 0;
        }
        .card-img,
        .card-img-top {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .jumbotron {
            background-color: black;
        }
        .list-group-item:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .modal-content {
            background-color: black;
            border-radius: 0;
        }
        .font-weight-bold {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }

        .btn-primary {
            color: white;
            background-color: black;
            border: 1px solid white;
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
        .small {
            font-size: 60%;
        }

        ::-webkit-scrollbar {
            background: transparent;
            width: 7px;
            border-radius: 0;
        }

        ::-webkit-scrollbar-thumb {
            background: white;
            border-radius: 0;
        }

    </style>

    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo-simple.png') }}" alt="logo" style="width: 100px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'about') == 0) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'giojs') == 0) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('giojs') }}">Globe</a>
                        </li>
                        @if (Auth::check())
                            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'messages') == 0) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('messages') }}">Chat</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        My Profile
                                    </a>

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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @auth
            <input id="token" type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
        @endauth
    </div>

    @yield('body')
</body>
</html>
