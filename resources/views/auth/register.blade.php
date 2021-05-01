@extends('layouts.app')

@section('title', 'Register')

@section('styles')
    <style rel="text/css">
        .login-form-container {
            padding: 40px !important;
        }
    </style>
@endsection

@section('content')
    <div class="login-register">
        <div class="container">
            <div class="row">
                <div class="login-register-area">
                    <div class="col-md-12">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav" id="login-register" role="tablist">
                                <a class="active" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                   aria-controls="register" aria-selected="false">
                                    <h4>Register</h4>
                                </a>
                            </div>
                            <div class="tab-content" id="login-registerContent">
                                <div class="tab-pane fade show active" id="register" role="tabpanel"
                                     aria-labelledby="register-tab">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{ route('register') }}" method="post">
                                                @csrf
                                                <input title="Display Name" id="display_name" type="text"
                                                       name="display_name"
                                                       value="{{ old('display_name') ?? NULL }}"
                                                       placeholder="Display Name" autofocus @error('display_name') border-danger @enderror/>
                                                @error('display_name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror

                                                <input title="Username" id="username" type="text"
                                                       name="username" class="mt-4"
                                                       value="{{ old('username') ?? NULL }}" placeholder="User Name" @error('username') border-danger @enderror/>
                                                @error('username')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror

                                                <input title="Email" id="email" type="email" name="email"
                                                       value="{{ old('email') ?? NULL }}" placeholder="Email" class="mt-4" @error('email') border-danger @enderror/>
                                                @error('email')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror

                                                <input title="Password" id="password" type="password"
                                                       name="password"
                                                       placeholder="Password" class="mt-4" @error('password') border-danger @enderror/>
                                                @error('password')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror

                                                <input title="Confirm Password" type="password"
                                                       id="password_confirmation" name="password_confirmation"
                                                       placeholder="Confirm Password" class="mt-4"/>
                                                <div class="button-box mt-4">
                                                    <button type="submit" class="btn gallery-btn-dark-yellow">
                                                        <span>Register</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
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
