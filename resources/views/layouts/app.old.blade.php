<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>txtr | @yield('title')</title>
    </head>

    <body>
        <h1>txtr | @yield('title')</h1>

        @if (session('message'))
            <p><b>{{ session('message') }}</b></p>
        @endif

        <div>
            @yield('content')
        </div>
    </body>
</html>
