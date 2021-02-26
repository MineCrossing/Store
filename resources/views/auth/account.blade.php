@extends('layouts.app')

@section('content')
    @component('components.breadcrumbs')
        <a class="breadcrumb-item active" href="/">Shop</a>
        <i class="fas fa-chevron-right breadcrumb-separator"></i>
        <span>Account</span>
    @endcomponent
    <div class="container bg-white rounded my-3">
        <h1 class="border-bottom">My Account</h1>

        <div class="row mx-2" >
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#myOrders" class="nav-link active" role="tab" data-toggle="tab">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a href="#myProfile" class="nav-link" role="tab" data-toggle="tab">My Profile</a>
                    </li>
                    @if (Auth::user()->can('browse_admin'))
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">Dashboard</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="myOrders">
                        <h3>View Orders</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Billing Name</th>
                                    <th scope="col">Billing Email</th>
                                    <th scope="col">Ordered</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->billing_name}}</td>
                                    <td>{{$order->billing_email}}</td>
                                    <td>{{ date('F dS, Y - g:iA' ,strtotime($order->created_at)) }}</td>
                                    <td><a href="{{route('orders.show', $order->id) }}">View Order</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="myProfile">
                        <h3>Edit Profile</h3>
                        <div class="row d-flex bg-light mt-2">
                            <div class="col-6">
                                <h5 style="font-weight: bold;">Your Name: </h5>
                            </div>
                            <div class="col-6">
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>
                        <div class="row d-flex bg-light mt-2">
                            <div class="col-6">
                                <h5 style="font-weight: bold;">Your Email: </h5>
                            </div>
                            <div class="col-6">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-12 text-center my-2 mx-0">
                            <a href="{{route('users.edit', Auth::user())}}" class="btn btn-info btn-block rounded">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection