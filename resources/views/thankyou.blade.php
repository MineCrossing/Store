@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="height: 100vh;">
        <div class="col-12 my-auto align-self-center text-center">
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
            <h1>Thank you for Your Order!</h1>
            <p>A confirmation email was sent</p>
            <a href="{{ route('shop.index')}}" class="btn btn-secondary">Home Page</a>
        </div>
    </div>
</div>
@endsection