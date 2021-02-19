@extends('layouts.app')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
    </div>

    <div class="container rounded">
        <div class="row my-5">
            <div class="col-6 offset-3 text-center bg-white py-2">
                <img class="rounded" src="/storage/products/{{$product->slug}}.png" alt="product" height="100%" width="50%">
            </div>
            <div class="col-6 offset-3 text-center bg-white">
                <h1 class="mb-5 text-center pt-2"><strong>{{ $product->name }}</strong></h1>

                <p class="text-secondary" style="font-size: 18px;opacity:0.7;"><strong>{{ $product->details }}</strong></p>
                <p style="font-size: 15px;">{{ $product->description }}</p>

                <!-- <a href="#" style="font-size:24px;" role="button" class="btn btn-outline-secondary">Add to Cart</a> -->
                <hr>
                <div class="row bg-white">
                    <div class="col-12 col-md-4">
                        <p class="text-muted font-italic"><strong>£{{ $product->price }}</strong></p>
                    </div>
                    <div class="col-12 col-md-5 offset-md-3 text-center">
                        <form action="{{route('cart.store')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">
                            <button type="submit" name="Submit" class="btn btn-success btn-sm">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection