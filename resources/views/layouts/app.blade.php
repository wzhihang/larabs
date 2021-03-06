<!doctype html>
<html lang="{{ config(app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', 'laravel爱好者社区')">
    <title>@yield('title', 'larabs') - laravelS</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">

        @include('layouts._header')

        <div class="container">
            @include('layouts._message')
            @yield('content')

        </div>

        @include('layouts._footer')
    </div>

    @if (app()->isLocal())
        @include('sudosu::user-selector')
    @endif

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts'))
</body>
</html>