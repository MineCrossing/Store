@extends('layouts.app')

@section('content')
@component('components.breadcrumbs')
    <a class="breadcrumb-item active" href="/">Shop</a>
    {{-- <i class="fas fa-chevron-right breadcrumb-separator"></i> --}}
@endcomponent
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="container d-none d-md-block">
    <div class="row py-3">
        <div class="col" id="main">
            <div class="productBox d-flex justify-content-between rounded p-2">
                <h1 class="categoryName">{{$categoryName}}</h1>
                <div class="price-range">
                    <span>Price: </span>
                    <a href="{{ route('shop.index', ['category'=>request()->category, 'sort' => 'low_high']) }}">Low to High</a> | 
                    <a href="{{ route('shop.index', ['category'=>request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                </div>
            </div>
            <div class="row p-2">
                @forelse($products as $product)
                    <div class="productBox col-3 rounded m-2 py-5">
                        <div class="d-inline">
                            <a href="/shop/{{$product->slug}}"><img class="mx-auto d-block" height="100%" width="100%" src="{{ asset('storage/'.$product->image)}}" alt="product"></a>
                            <a href="/shop/{{$product->slug}}"><div class="product-name text-left">{{ $product->name }}</div></a>
                            <div class="product-price text-muted font-italic">£{{ $product->price }}</div>
                        </div>
                    </div>
                @empty
                    <div class="py-5">
                        <h3>
                            No Items Found
                        </h3>
                    </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        <div class="col-3" id="#">
            <div class="#">
                <nav class="navbar navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="categoryHeader" href="{{ route('shop.index') }}">By Category: </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item {{  setActiveCategory($category->slug) }}">
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="nav-link">{{$category->name}}</a>
                            </li>
                        @endforeach
                        <li class="nav-item border-top">
                            <div class="categoryHeader">Cart </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="navar-brand"><i class="fas fa-shopping-cart shopping-icon"></i>
                                @if (Cart::instance('default')->count() > 0)
                                    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- Mobile View --}}
<div class="container d-block d-md-none">
    <div class="row py-3">
        <div class="col-12 pt-5" id="sticky-sidebar">
            <div class="sticky-top">
                <nav class="navbar navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="categoryHeader" href="{{ route('shop.index') }}">By Category: </a>
                        </li>
                        @foreach($categories as $category)
                            <li class="nav-item {{  setActiveCategory($category->slug) }}">
                                <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="nav-link">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-12 pt-5">
            <div class="d-flex justify-content-between">
                <div class="row bg-white">
                    <div class="col-12 text-center">
                        <h1 class="categoryName">{{$categoryName}}</h1>
                    </div>
                    <div class="col-12 text-center">
                        <div class="price-range">
                            <span>Price: </span>
                            <a href="{{ route('shop.index', ['category'=>request()->category, 'sort' => 'low_high']) }}">Low to High</a> |
                            <a href="{{ route('shop.index', ['category'=>request()->category, 'sort' => 'high_low']) }}">High to Low</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 my-2" id="main">
            <div class="row justify-content-center">
                @forelse($products as $product)
                    <div class="productBox col-10 offset-2 rounded m-2 py-5">
                        <div class="">
                            <a href="/shop/{{$product->slug}}"><img class="mx-auto d-block" height="100%" width="100%" src="{{ asset('storage/'.$product->image)}}" alt="product"></a>
                            <a href="/shop/{{$product->slug}}"><div class="product-name text-center">{{ $product->name }}</div></a>
                            <div class="product-price text-muted font-italic text-center">£{{ $product->price }}</div>
                        </div>
                    </div>
                @empty
                    <div class="py-5">
                        <h3 class="bg-white">
                            No Items Found
                        </h3>
                    </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection