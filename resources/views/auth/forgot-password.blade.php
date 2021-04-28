@extends('layouts.app')
@section('title','Forgot password')
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
                                        <h4>Forgot-password</h4>
                                    </a>
                                </div>
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <span class="forgot">Please enter your email address below and we will send you information to change your password.</span>
                                            <input type="email" id="email" name="email" placeholder="Email" value="{{old('email') ?? ''}}" />
                                            <div class="button-box">
                                                <button type="submit" class="btn gallery-btn-dark-yellow"><span>Get Link</span></button>
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
@section('page-footer')
    @if(session()->has('status'))
        <script type="text/javascript">
            toastr.info('<?php echo session()->get('status'); ?>')
        </script>
    @endif
@endsection
