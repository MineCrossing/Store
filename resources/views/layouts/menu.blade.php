{{-- <div class="d-flex justify-content-center text-center" id="nav-box">
    <ul id="navbar">
        <li><a href="https://minecrossing.xyz"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="https://minecrossing.xyz/blog"><i class="fas fa-comment-dots"></i> Blog</a></li>
        <li><a href="https://minecrossing.xyz/leaderboards"><i class="fas fa-chart-bar"></i> Leaderboards</a></li>
        <li><a href="https://minecrossing.xyz/rules"><i class="fas fa-scroll"></i> Rules</a></li>
        <li><a href="https://minecrossing.xyz/chat"><i class="fas fa-comments"></i> Chat</a></li>
        <li><a href="https://minecrossing.xyz/map"><i class="fas fa-map-marked-alt"></i> World Map</a></li>
        <li><a class="active" id="store" href="{{route('shop.index')}}"><i class="fas fa-shopping-cart"></i> Store</a></li>
        @guest
        <li><a id="login" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        @else
        <li><a href="/myaccount">My Account</a></li>
        <li><a id="logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endguest
    </ul>
</div> --}}

<div id="nav-box">
    <ul id="navbar" class="pure-u-1-3">
        <li><a href="https://minecrossing.xyz"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="https://minecrossing.xyz/blog"><i class="fas fa-book"></i> Blog</a></li>
        <li><a href="https://minecrossing.xyz/leaderboards"><i class="fas fa-chart-bar"></i> Leaderboards</a></li>
        <li><a href="https://minecrossing.xyz/rules"><i class="fas fa-scroll"></i> Rules</a></li>
        <li><a href="https://minecrossing.xyz/chat"><i class="fas fa-comments"></i> Chat</a></li>
        <li><a href="https://minecrossing.xyz/map"><i class="fas fa-map-marked-alt"></i> World Map</a></li>
        <li><a class="active" id="store" href="{{route('shop.index')}}"><i class="fas fa-shopping-cart"></i> Store</a></li>
        @guest
        <li><a id="login" href="{{route('login')}}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        @else
        <li><a href="/myaccount">My Account</a></li>
        <li><a id="logout" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        @endguest
    </ul>
</div>
