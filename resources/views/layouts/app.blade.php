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
    </style>

    @yield('extra-css')
</head>
<body>
    <div id="app">
        <div class="container text-center" id="image-header">
            <div class="row">
                <div class="col-12 d-block d-md-none">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" height="300px" width="100%">
                </div>
                <div class="col-12 d-none d-md-block">
                    <img src="/storage/images/title.png" alt="MineCrossing Store" height="300px" width="600px">
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{ menu('main', 'layouts.menu') }}
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
    <!-- Scripts -->
    @yield('extra-js')
</body>
</html>
