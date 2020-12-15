<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>txtr | @yield('title')</title>
    </head>

    <body>
        <h1>txtr | @yield('title')</h1>

        <div>
            @yield('content')
        </div>
    </body>
</html>
