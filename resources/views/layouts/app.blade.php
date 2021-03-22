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
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.5/build/pure-min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
        
        * {
            font-family: 'Roboto', sans-serif;
        }       
    </style>

    @yield('extra-css')
</head>
<body>
    <div id="app">
        <div class="container text-center" id="image-header">
            <div class="row">
                <div class="col-12 d-block d-md-none">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" width="100%">
                </div>
                <div class="col-12 d-none d-md-block">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" width="600px">
                </div>
            </div>
        </div>
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
