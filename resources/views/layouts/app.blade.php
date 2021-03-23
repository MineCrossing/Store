<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MineCrossing || Store</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        
        * {
            font-family: 'Roboto', sans-serif;
        }    
        .store-header {
            background-image: url("/storage/images/background.png");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }   
    </style>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css">
    @yield('extra-css')
</head>
<body>
    <div id="app">
        <header class="store-header">
            <div class="row text-center">
                <div class="col-12 d-block d-md-none">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" class="logo pure-img pure-u-1-3" width="100%">
                </div>
                <div class="col-12 d-none d-md-block">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" class="logo pure-img pure-u-1-3" width="100%">
                </div>
            </div>
        </header>
        {{ menu('main', 'layouts.menu') }}

        <main class="">
            @yield('content')
        </main>

    </div>

    @include('partials.footer')
    <!-- Scripts -->
    @yield('extra-js')
</body>
</html>
