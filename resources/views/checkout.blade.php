@extends('layouts.app')

@section('extra-css')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <h1 class="border-dark border-top border-bottom" style="width:5%;">Checkout</h1>
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
        <div class="row my-5 py-2 bg-white">
            <div class="col-6">
                {!! Form::open(['action' => 'CheckoutController@store', 'method' => 'POST', 'id' => 'payment-form']) !!}
                    <div class="form-group">
                        <h3>Billing Details</h3>
                    </div>
                    <div class="form-group row">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'Email Address')}}
                        {{ Form::text('email', '', ['class' => 'form-control', 'value' => 'old("email")', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Name')}}
                        {{ Form::text('name', '', ['class' => 'form-control', 'value' => 'old("name")', 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('address', 'Address')}}
                        {{ Form::text('address', '', ['class' => 'form-control', 'value' => 'old("address")', 'required']) }}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-5">
                            {{ Form::label('city', 'City')}}
                            {{ Form::text('city', '', ['class' => 'form-control', 'value' => 'old("city")', 'required']) }}
                        </div>
                        <div class="form-group col-4">
                            {{ Form::label('county', 'County')}}
                            {{ Form::text('county', '', ['class' => 'form-control', 'value' => 'old("county")', 'required']) }}
                        </div>
                        <div class="form-group col-3">
                            {{ Form::label('postcode', 'Postcode')}}
                            {{ Form::text('postcode', '', ['class' => 'form-control', 'value' => 'old("postcode")', 'required']) }}
                        </div>                    
                    </div>
                    <div class="form-group">
                        {{ Form::label('phone', 'Mobile Number') }}
                        {{ Form::number('phone', '', ['class' => 'form-control', 'value' => 'old("phone")', 'required']) }}
                    </div>

                    <hr>

                    <div class="form-group">
                        <h3>Payment Details</h3>
                    </div>

                    <div class="form-group">
                        {{ Form::label('name_on_card', 'Name on Card') }}
                        {{ Form::text('name_on_card', '', ['class' => 'form-control', 'required']) }}
                    </div>

                    <div class="form-group">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    {{ Form::submit('Submit Payment', ['class' => 'btn btn-success btn-lg btn-block', 'id' => 'complete-order']) }}
                {!! Form::close() !!}
            </div>
            <div class="col-5 offset-1">
                <div class="row bg-white">
                    <div class="col-12">
                        <h3>Your Order</h3>
                    </div>
                    @foreach(Cart::instance('default')->content() as $item)
                        <div class="row">
                            <div class="col-4 my-2">
                                <img src="{{ asset('storage/'.$item->model->image)}}" alt="item" height="100%" width="100%">
                            </div>
                            <div class="col-6 my-2">
                                <p>{{ $item->model->name }}</p>
                                <p>{{ $item->model->description }}</p>
                                <p>£{{ $item->model->price }}</p>
                            </div>
                            <div class="col-2 my-auto text-center">
                                <div class="border">
                                    {{ $item->qty }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row my-3" style="background-color: #F5F5F5">
                    <div class="col-12">
                        <div class="text-right">
                                <div class="row">
                                    <div class="col-12">
                                        Total: £{{ Cart::total() }}<br>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row my-3 bg-white">
                    <div class="col-12">
                        <p>Have a code?</p>
                    </div>
                    <div class="col-12 form-group">
                        {!! Form::open(['action' => 'CouponsController@store', 'method' => 'POST']) !!}
                            {{ Form::text('code', '', ['class' => 'form-control', 'id' => 'coupon_code', 'placeholder' => 'e.g. Discount']) }}
                            {{ Form::submit('Apply', ['class' => 'btn btn-outline-secondary btn-block mt-4']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        (function() {

            var stripe = Stripe('{{ config("services.stripe.key") }}');

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                    color: 'darkgrey'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true
                });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.on('change', event => {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
            });

            // Handle form submission.
            document.getElementById('payment-form').addEventListener('submit', event => {
                event.preventDefault();

                document.getElementById('complete-order').disabled = true;

                var options = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('county').value,
                    address_zip: document.getElementById('postcode').value,
                }

                stripe.createToken(card, options).then(function(result) {
                    if (result.error) {
                    // Inform the user if there was an error.
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    document.getElementById('complete-order').disabled = false;
                    } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                const form = document.getElementById('payment-form');
                let hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // // Submit the form
                form.submit();
            }
        })();
    </script>
@endsection
