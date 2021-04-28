@extends('layouts.app')
@section('title','Reset password')
@section('content')
    <div id="main">
        <div class="login-register">
            <div class="container">
                <div class="row">
                    <div class="login-register-area">
                        <div class="col-md-12">
                            <div class="login-register-wrapper">
                                <div class="login-register-tab-list">
                                    <a class="active">
                                        <h4>New password</h4>
                                    </a>
                                </div>
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="{{ route('password.update') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                            <input id="email" type="hidden" name="email" value="{{$request->email ?? ''}}" readonly />
                                            <label>New Password</label>
                                            <input id="password" class="" type="password" name="password" />
                                            <label>Confirm Password</label>
                                            <input type="password" id="password_confirmation" class="" type="password" name="password_confirmation" />
                                            <div class="button-box">
                                                <button type="submit" class="btn gallery-btn-dark-yellow"><span>Change Password</span></button>
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
@endsection
