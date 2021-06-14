@extends('layouts.app')
@section('title','Reset password')
@section('content')

<div class="login-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="loginregistertext">New password</h2>
                <div class="login-registerwrapper">
                    <div class="login-register-form">
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <input id="email" type="hidden" name="email" value="{{$request->email ?? ''}}" readonly
                            class="arts-control"/>

                            <div class="artsinput">
                                <label>New Password</label>
                                <input id="password" class="arts-control @error('password') border border-danger @enderror" type="password" name="password"
                                style="margin-bottom: 0;"/>
                                @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="artsinput mt-4">
                                <label>Confirm Password</label>
                                <input id="password_confirmation" class="arts-control @error('password_confirmation') border border-danger @enderror" type="password"
                                    name="password_confirmation" style="margin-bottom: 0;" />
                                @error('password_confirmation')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <label>New Password</label>
                            <input id="password" class="arts-control" type="password" name="password" /> --}}

                            {{-- <label>Confirm Password</label>
                            <input  class="arts-control" type="password" name="password_confirmation" /> --}}

                            <div class="button-box text-center mt-4">
                                <button type="submit" class="btngreen"><span>Change
                                        Password</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
