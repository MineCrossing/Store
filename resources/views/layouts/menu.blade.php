<ul class="navbar-nav mr-auto">
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
    @endauth --}}
</ul>
<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
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
</ul>