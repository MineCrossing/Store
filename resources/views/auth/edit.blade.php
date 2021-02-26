@extends('layouts.app')

@section('content')
    <div class="container bg-white rounded">
        <div class="text-center" style="font-size: 16px;"><strong>{{ __('Edit Profile') }}</strong></div>
        {!! Form::open(['action' => ['UsersController@update', $user->id], 'files' => true, 'method' => 'POST']) !!}
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
            {{-- Name Input --}}
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-user"></span>
                            </span>
                        </div>
                        {{Form::text('name', $user->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter your name','autofocus' => 'autofocus', 'required' => 'required'])}}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fas fa-at"></span>
                            </span>
                        </div>
                        {{Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter your email','autofocus' => 'autofocus', 'required' => 'required'])}}
                    </div>
                </div>
            </div>

            {{--Password Input --}}
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    {{ Form::label('password', 'Current Password') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </span>
                        </div>
                        {{Form::password('password', ['id'=>'password', 'class' => 'form-control', 'autocomplete' => 'new-password']) }}
                    </div>
                </div>
            </div>

            {{--Password Input --}}
            <div class="form-group row">
                <div class="col-md-8 offset-md-2">
                    {{ Form::label('password2', 'New Password') }}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fas fa-key"></span>
                            </span>
                        </div>
                        {{Form::password('passwordnew', ['id'=>'password2', 'class' => 'form-control', 'autocomplete' => 'new-password']) }}
                    </div>
                </div>
            </div>
            {{Form::hidden('_method', 'PATCH')}}
            <div class="form-group row">{{Form::submit('Save', ['class' => 'btn btn-primary btn-block'])}}</div>
        {!! Form::close() !!}
    </div>  
@endsection

                    {{-- Name Input
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </span>
                                </div>
                                {{Form::text('name', $user->name, ['class' => 'form-control @error('name') is-invalid @enderror', 'id' => 'name', 'placeholder' => 'Enter your name', required, autofocus])}}
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Email Input
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-at"></span>
                                    </span>
                                </div>
                                <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Password Input
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fas fa-key"></span>
                                    </span>
                                </div>
                                <input placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}