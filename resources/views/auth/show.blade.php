@extends('layouts.app')

@section('content')
    @if (Auth::user()->id !== $order->user_id)
        <div class="alert alert-danger">
            You do not own this order!
        </div>
    @else
    @component('components.breadcrumbs')
        <a class="breadcrumb-item active" href="/">Shop</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <a class="breadcrumb-item active" href="/myaccount">My Account</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span>Order</span>
    @endcomponent
        <div class="container bg-white rounded mt-5">
            <h1>Order #: {{$order->id}}</h1>
            <div class="row">
                <div class="col-md-6">
                    <strong>Billing Name:</strong>
                    {{$order->billing_name}} 
                </div>
                <div class="col-md-6">
                    <strong>Billing Email:</strong>
                    {{$order->billing_email}} 
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <strong>Billing Address:</strong>
                    {{$order->billing_address}} 
                </div>
                <div class="col-md-4">
                    <strong>Billing City:</strong>
                    {{$order->billing_city}}
                </div>
                <div class="col-md-4">
                    <strong>Billing County:</strong>
                    {{$order->billing_county}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <strong>Billing Postcode:</strong>
                    {{$order->billing_postcode}}
                </div>
                <div class="col-md-6">
                    <strong>Billing Contact Number:</strong>
                    {{$order->billing_phone}}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <strong>Total:</strong>
                    £{{$order->billing_total}}
                </div>
                <div class="col-md-6">
                    <strong>Payment Method:</strong>
                    {{$order->payment_gateway}}
                </div>
            </div>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>£{{$product->price}}</td>
                            <td>{{$product->description}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection