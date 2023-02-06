<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RAG43') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <main class="py-4" style="margin-bottom: 60px">
            @yield('content')
        </main>
    </div>
    <footer class="bg-light text-center text-lg-start fixed-bottom">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2023 Powered By:
            <a class="text-dark" href="https://techavancer.com/" target="_blank">Techavancer.com</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>
