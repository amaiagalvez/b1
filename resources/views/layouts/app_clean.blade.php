<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $app_name }} :: @yield('title') </title>


    <!-- Fonts -->
    <link href="{{ asset('helpers/css/fontawesome-free/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="c-sidebar-brand-full" src="{{ asset('images/logo.png') }}" width="auto" height="46"
                     alt="{{env('APP_NAME', '')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

            </div>
        </div>
    </nav>

    @include('basics::layouts._partials.alerts')

    <div id="c-body" class="c-body">
        <main id="app" class="c-main">

            @yield('content')

        </main>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('helpers/js/jquery.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

{{--<script src="{{ asset('js/theme.js') }}"></script>--}}

@yield('scripts')

</body>

</html>
