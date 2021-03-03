@extends('layouts.app')

@section('content')
@component('components.breadcrumbs')
    <a href="/">Shop</a>
    <i class="fas fa-chevron-right breadcrumb-separator"></i>
    <span>Search</span>
@endcomponent
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('info'))
            <div class="alert alert-info">
                {{ session()->get('info') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
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

    <div class="container rounded">
        <div class="searchInformation col-md-5">
            <h1>Search Results</h1>
            <p>We found {{$products->count()}} result(s) for {{ request()->input('query')}}</p>
        </div>

        <div class="row p-2">
            @forelse($products as $product)
                <div class="col-3 bg-white rounded m-2 py-5">
                    <div class="text-center">
                        <a href="/shop/{{$product->slug}}"><img class="mx-auto d-block" height="100%" width="100%" src="{{ asset('storage/'.$product->image)}}" alt="product"></a>
                        <a href="/shop/{{$product->slug}}"><div class="search-product">{{ $product->name }}</div></a>
                        <div class="search-price">£{{ $product->price }}</div>
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
    </div>
@endsection
@section('extra-js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection