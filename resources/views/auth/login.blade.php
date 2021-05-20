@extends('layouts.app')

@section('title','Login')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="login-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="loginregistertext">Login</h2>
                <div class="login-registerwrapper">
                    <div class="login-register-form">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="artsinput">
                                <input id="email" title="Email Address" type="email" name="email"
                                    value="{{ old('email') ?? NULL }}" placeholder="Email"
                                    class="arts-control @error('email') border-danger border @enderror" autofocus style="margin-bottom: 0;"/>
                                @error('email')
                                <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="artsinput mt-4">
                                <input id="password" title="Password" type="password" name="password"
                                    placeholder="Password" class="arts-control" />
                            </div>
                            <div class="artscheck">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="remeberme">
                                    <label class="form-check-label" for="remeberme">
                                        Remember me
                                    </label>
                                </div>
                                <div class="forgotpassword">
                                    <a href="{{ route('password.request') }}" class="forgot">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="loginbtn">
                                <button type="submit" class="btngreen">Login</button>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="form-group row col-md-12 mt-4">
                        <div class="col-md-6" style="text-align: right;">
                            <a href="{{ url('login/facebook') }}" class="fb btn">
                            <i class="fa fa-facebook fa-fw"></i> Facebook </a>
                        </div>
                        <div class="col-md-6" style="text-align: left;">
                            <a href="{{ url('login/google') }}" class="google btn"><i class="fa fa-google fa-fw">
                                </i> Google
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
