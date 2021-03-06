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
    <link href="{{ asset('basics/css/fontawesome-free/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('basics/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('basics/css/styles_basics.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    @include('basics::layouts._partials.menu')

    @include('basics::layouts._partials.header')

    @include('basics::layouts._partials.alerts')

    <div id="c-body" class="c-body">
        <main id="app" class="c-main">

            @yield('content')

        </main>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('basics/js/jquery.min.js') }}"></script>
<script src="{{ asset('basics/js/popper.min.js') }}"></script>
<script src="{{ asset('basics/js/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('basics/js/theme.js') }}"></script>
<script src="{{ asset('basics/js/datatables.min.js') }}"></script>

<script src="{{ asset('basics/js/dt.js') }}"></script>

{!!  getLocalizedJS('/basics')  !!}

<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')

</body>

</html>
