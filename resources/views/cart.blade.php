@extends('layouts.app')

@section('content')
@component('components.breadcrumbs')
    <a href="/">Shop</a>
    <i class="fas fa-chevron-right breadcrumb-separator"></i>
    <span>Cart</span>
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
    <div class="container cart-section">
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
        @if(Cart::count() > 0)
            <div class="mt-2">
                <h1 class="cartHeader">{{ Cart::count() }} item(s) in Shopping Cart</h1>
                    
                <div class="container">
                    <div class="row my-5 d-none d-md-block">
                        <div class="col-12 col-md-8">
                            @foreach(Cart::content() as $item)
                                <div class="row border-top border-bottom border-dark py-2 bg-white">
                                    <div class="col-4">
                                        <a href="{{ route('shop.show', $item->model->slug) }}" alt="product"><img src="{{ asset('storage/'.$item->model->image)}}" alt="Product" width="100%" height="100%"></a>
                                    </div>
                                    <div class="col-3 my-5">
                                        <div class="details">
                                            <p><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></p>
                                            <p class="text-secondary font-italic">{{ $item->model->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-2 my-5 actions">
                                        <p class="float-right">
                                            <!-- <a href="" style="text-decoration: none;color: black;">Remove</a> -->
                                            {!! Form::open(['action' => array('CartController@destroy', $item->rowId), 'method' => 'DELETE']) !!}
                                                {{ Form::submit('Remove', ['style' => 'color:black;text-decoration: none; border:none; background: none;float: right;']) }}
                                            {!! Form::close() !!}
                                        </p>
                                        <p class="float-right">
                                            <!-- <a href="#" style="text-decoration: none;color: black;">Save for Later</a> -->
                                            {!! Form::open(['action' => array('CartController@switchToSaveForLater', $item->rowId), 'method' => 'POST']) !!}
                                                {{ Form::submit('Save for Later', ['style' => 'color:black;text-decoration: none; border:none; background: none;float: right;']) }}
                                            {!! Form::close() !!}
                                        </p>
                                    </div>
                                    <div class="col-1 my-5">
                                        <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                            @for ($i = 1; $i < 10 + 1 ; $i++)
                                                <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2 my-5 item-subtotal">
                                        £{{ $item->subtotal() }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="row my-3" id="totalBox">
                                <div class="col-12">
                                    <div class="text-right">
                                            <div class="font-weight-bold">Total: £{{ Cart::total() }}</div>
                                    </div>
                                </div>
                                <div class="col-12 border-top border-dark">
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <div class="float-left">
                                                <a href="{{ route('shop.index') }}" class="btn btn-info btn-sm text-minecrossing">Continue Shopping</a>
                                            </div>
                                        </div>
                                        <div class="col-6 py-2">
                                            <div class="float-right">
                                                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-sm">Proceed to Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mobile View --}}
                <div class="container">
                    <div class="row my-5 d-block d-sm-block d-md-none">
                        <div class="col-12 col-md-8">
                            @foreach(Cart::content() as $item)
                                <div class="row border-top border-bottom border-dark py-2 bg-white d-block d-sm-block d-md-none">
                                    <div class="col-12">
                                        <a href="{{ route('shop.show', $item->model->slug) }}" alt="product"><img src="{{ asset('storage/'.$item->model->image)}}" alt="Product" width="100%" height="100%"></a>
                                    </div>
                                    <div class="col-12 my-5">
                                        <div class="details">
                                            <p><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></p>
                                            <p class="text-secondary font-italic">{{ $item->model->description }}</p>
                                        </div>
                                        <p class="float-left">
                                            <!-- <a href="" style="text-decoration: none;color: black;">Remove</a> -->
                                            {!! Form::open(['action' => array('CartController@destroy', $item->rowId), 'method' => 'DELETE']) !!}
                                                {{ Form::submit('Remove', ['style' => 'color:black;text-decoration: none; border:none; background: none;float: right;']) }}
                                            {!! Form::close() !!}
                                        </p>
                                        <p class="float-left">
                                            <!-- <a href="#" style="text-decoration: none;color: black;">Save for Later</a> -->
                                            {!! Form::open(['action' => array('CartController@switchToSaveForLater', $item->rowId), 'method' => 'POST']) !!}
                                                {{ Form::submit('Save for Later', ['style' => 'color:black;text-decoration: none; border:none; background: none;float: right;']) }}
                                            {!! Form::close() !!}
                                        </p>
                                    </div>
                                    <div class="col-12 my-5">
                                        <div class="row">
                                            <div class="col-3">
                                                <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->model->quantity }}">
                                                    @for ($i = 1; $i < 10 + 1 ; $i++)
                                                        <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-3 offset-6 item-subtotal">
                                                £{{ $item->subtotal() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row my-3" id="totalBox">
                                <div class="col-12">
                                    <div class="text-right">
                                            <div class="font-weight-bold">Total: £{{ Cart::total() }}</div>
                                    </div>
                                </div>
                                <div class="col-12 border-top border-dark">
                                    <div class="row">
                                        <div class="col-6 py-2">
                                            <div class="float-left">
                                                <a href="{{ route('shop.index') }}" class="btn btn-info btn-sm">Continue Shopping</a>
                                            </div>
                                        </div>
                                        <div class="col-6 py-2">
                                            <div class="float-right">
                                                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-sm">Proceed to Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container my-5">
                <h3>No items in Cart!</h3>
                <a href="{{ route('shop.index') }}" class="btn btn-info btn-sm">Continue Shopping</a>
            </div>
        @endif

        @if(Cart::instance('saveForLater')->count() > 0)
            <div class="saveLaterBox col-12">
                <div class="ml-3 mt-3">
                    <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved for Later</h2>
                </div>
    
                <div class="row mx-auto mb-5">
                    <div class="col-md-8">
                        @foreach(Cart::instance('saveForLater')->content() as $item)
                        <div class="row border-top border-bottom border-dark py-2">
                                <div class="col-md-4">
                                    <a href="{{ route('shop.show', $item->model->slug) }}" alt="product"><img src="{{ asset('storage/'.$item->model->image)}}" alt="Product" width="100%" height="100%"></a>
                                </div>
                                <div class="col-md-5 my-5">
                                    <div class="details">
                                        <p><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></p>
                                        <p class="text-secondary font-italic">{{ $item->model->description }}</p>
                                    </div>
                                </div>
                                <div class="col-md-1 my-5 actions">
                                    <p class="float-md-right">
                                        <!-- <a href="#" style="text-decoration: none;color: black;">Save for Later</a> -->
                                        {!! Form::open(['action' => array('SaveForLaterController@switchToCart', $item->rowId), 'method' => 'POST']) !!}
                                            {{ Form::submit('Move to Cart', ['style' => 'color:black;text-decoration: none; border:none; background: none;float: right;']) }}
                                        {!! Form::close() !!}
                                    </p>
                                </div>
                                <div class="col-md-2 my-5 item-subtotal">
                                    £{{ $item->model->price }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else

        @endif

    </div> <!-- End cart section -->
@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        /**
         * 
         */
        (function() {
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element) {
                element.addEventListener('change', function() {
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')

                    axios.patch(`cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                        window.location.href = '{{ route("cart.index") }}'
                    })
                    .catch(function (error) {
                        console.log(error);
                        window.location.href = '{{ route("cart.index") }}'
                    });
                })
            })
        })();
    </script>
@endsection