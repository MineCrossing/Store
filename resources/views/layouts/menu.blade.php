{{-- <ul class="navbar-nav mr-auto">
    @foreach ($items as $menu_item)
        <li class="nav-item">
            <a href="{{ $menu_item->link() }}" class="nav-link">{{$menu_item->title}}
            @if ($menu_item->title === "Cart")
                @if(Cart::instance('default')->count() > 0)
                    <span class="cart-count rounded" style="background-color: skyblue;"><span>{{ Cart::instance('default')->count() }}</span></span>
                @endif
            @endif
            </a>
        </li>
    @endforeach
    {{-- @auth
        <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endauth
</ul> --}}
<div class="nav-style d-flex justify-content-center text-center" id="navbar-style">
    <ul>
        <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#news"><i class="fas fa-comment-dots"></i> Blog</a></li>
        <li><a href="#contact"><i class="fas fa-chart-bar"></i> Leaderboards</a></li>
        <li><a href="#about"><i class="fas fa-scroll"></i> Rules</a></li>
        <li><a href="#about"><i class="fas fa-question-circle"></i> Support</a></li>
        <li><a href="#about"><i class="fas fa-map-marked-alt"></i> World Map</a></li>
        <li><a class="active" id="store" href="{{route('shop.index')}}"><i class="fas fa-shopping-cart"></i> Store</a></li>
        @guest
        <li><a id="login" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        @else
        <li><a id="logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endguest
    </ul>
</div>
<!-- Right Side Of Navbar -->
{{-- <ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
        
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Hello, {{Auth::user()->name}} | {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endguest
</ul> --}}