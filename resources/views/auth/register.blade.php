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
            <div class="col-md-12">
                <h2 class="loginregistertext">Register</h2>
                <div class="login-registerwrapper">
                    <div class="login-register-form">
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="artsinput">
                                <input title="Display Name" id="display_name" type="text" name="display_name"
                                    value="{{ old('display_name') ?? NULL }}" placeholder="Display Name" autofocus
                                    class="arts-control @error('display_name') border border-danger @enderror"
                                    style="margin-bottom: 0;" />
                                @error('display_name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="artsinput">
                                <input title="Username" id="username" type="text" name="username"
                                    class="mt-4 arts-control @error('username') border border-danger @enderror" value="{{ old('username') ?? NULL }}"
                                    placeholder="User Name"
                                    style="margin-bottom: 0;" />
                                @error('username')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="artsinput"><input title="Email" id="email" type="email" name="email"
                                    value="{{ old('email') ?? NULL }}" placeholder="Email" class="mt-4 arts-control
                                    @error('email') border border-danger @enderror" style="margin-bottom: 0;" />
                                @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="artsinput"><input title="Password" id="password" type="password" name="password"
                                    placeholder="Password" class="mt-4 arts-control @error('password') border border-danger
                                    @enderror" style="margin-bottom: 0;" />
                                @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="artsinput">
                                <input title="Confirm Password" type="password" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password"
                                    class="mt-4 arts-control" style="margin-bottom: 0;" />
                            </div>

                            <div class="loginbtn mt-4">
                                <button type="submit" class="btndarkyellow">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
