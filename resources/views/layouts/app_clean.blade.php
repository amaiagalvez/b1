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

    <link href="{{ asset('helpers/css/styles_helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('basics/css/styles_basics.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body class="">

<div id="c-body" class="c-body">
    <main id="app" class="c-main">

        @yield('content')

        </main>
    </div>

<!-- Scripts -->
<script src="{{ asset('helpers/js/jquery.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

{{--<script src="{{ asset('js/theme.js') }}"></script>--}}

@yield('scripts')

</body>

</html>
