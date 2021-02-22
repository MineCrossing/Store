<div class="nav-style d-flex justify-content-center text-center" id="navbar-style">
    <ul>
        <li><a href="#home"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#news"><i class="fas fa-comment-dots"></i> Blog</a></li>
        <li><a href="#contact"><i class="fas fa-chart-bar"></i> Leaderboards</a></li>
        <li><a href="#about"><i class="fas fa-scroll"></i> Rules</a></li>
        <li><a href="#about"><i class="fas fa-question-circle"></i> Support</a></li>
        <li><a href="https://map.minecrossing.xyz/" target="_blank"><i class="fas fa-map-marked-alt"></i> World Map</a></li>
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
