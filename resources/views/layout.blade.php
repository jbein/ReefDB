<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ReefDB 2.0.0</title>

        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="content">
            @yield('content')
        </div>

        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
    </body>
</html>
