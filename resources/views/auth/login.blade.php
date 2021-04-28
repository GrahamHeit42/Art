@extends('layouts.app')

@section('title','Login')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="login-register">
        <div class="container">
            <div class="row">
                <div class="login-register-area">
                    <div class="col-md-12">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav" id="login-register" role="tablist">
                                <a class="active" id="login-tab" data-toggle="tab" href="#login" role="tab"
                                   aria-controls="login" aria-selected="true">
                                    <h4>Login</h4>
                                </a>
                            </div>
                            <div class="tab-content" id="login-registerContent">
                                <div class="tab-pane fade show active" id="login" role="tabpanel"
                                     aria-labelledby="login-tab">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{ route('login') }}" method="post">
                                                @csrf
                                                <input id="email" title="Email Address" type="email" name="email"
                                                       value="{{ old('email') ?? NULL }}" placeholder="Email"
                                                       autofocus />
                                                <input id="password" title="Password" type="password" name="password"
                                                       placeholder="Password" />
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <div class="login-option">
                                                            <label>
                                                                <input title="Remember Me" type="checkbox" />
                                                                <a class="flote-none" href="javascript:void(0)">Remember
                                                                    me
                                                                </a>
                                                            </label>
                                                        </div>
                                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                                    </div>
                                                    <div class="button-box">
                                                        <button type="submit" class="btn gallery-btn-green">
                                                            <span>Login</span>
                                                        </button>
                                                    </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection
