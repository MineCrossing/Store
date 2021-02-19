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
</ul>