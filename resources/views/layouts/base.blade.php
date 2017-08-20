{{ header('X-Frame-Options: SAMEORIGIN') }}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            @include('layouts.header')

            @yield('content')

            @include('layouts.footer')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
