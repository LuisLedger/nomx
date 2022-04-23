<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <!-- CSRF Token -->
        <meta content="{{ csrf_token() }}" name="csrf-token">
        @yield('metas')
        <title>{{ (isset($title))?$title:config('app.name', 'Laravel') }}</title>
        {{-- <link rel="shortcut icon" href="{{ asset('imgs/logo-ico.png') }}"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Scripts -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script defer="" src="{{ asset('js/app.js') }}"></script>
        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('css')
    </head>
    <body>
        <div id="app">
            @isset ($show_header)
            @else
                @include('layouts.components.header')
            @endisset
            <main class="{{ (isset($no_padding_top))?'':'py-4'}}">
                @yield('content')
            </main>
        </div>
        @isset ($view_footer)
            @include('layouts.components.footer')
        @endif
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.js" integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI=" crossorigin="anonymous"></script>
    @yield('scripts')
</html>
