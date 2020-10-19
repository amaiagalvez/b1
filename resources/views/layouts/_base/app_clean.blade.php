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

    <link href="{{ asset('basics/css/styles_basics.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body class="">
<div class="content">
    <header class="mt-3 c-header c-header-light c-header-fixed c-header-with-subheader">
        <a href="{{route('front.home')}}" class="ml-5">
            <img class="c-sidebar-brand-full" src="{{ asset('images/logo.png') }}" width="auto" height="46"
                 alt="{{ $app_name }}">
        </a>

        <ul class="c-header-nav ml-auto mr-4">
            @guest()
                <li class="c-header-nav-item">
                    <a class="c-header-nav-link"
                       href="{{route('login')}}" role="button"
                       aria-expanded="false">
                        <i class="far fa-user-circle"></i> {{ trans('basics::auth.login') }}
                    </a>
                </li>

            @else
                <li class="c-header-nav-item">
                    <a class="c-header-nav-link"
                       href="{{route('basics.home')}}" role="button"
                       aria-expanded="false">
                        <i class="far fa-user-circle"></i> {{ trans('basics::basics.home') }}
                    </a>
                </li>
            @endauth
        </ul>
    </header>
</div>

<div id="c-body" class="c-body mt-5 pt-5">
    <main id="app" class="c-main">

        @yield('content')

    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('basics/js/jquery.min.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')

</body>

</html>
