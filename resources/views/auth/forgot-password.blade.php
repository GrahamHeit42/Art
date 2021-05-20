@extends('layouts.app')
@section('title','Forgot password')
@section('content')
<div class="login-register">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="loginregistertext">Forgot-Password</h2>
                    <div class="login-registerwrapper">
                        <div class="login-register-form">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <h2 class="forgottext">
                                    Please enter your email address below and we will send you information to change your password.
                                </h2>
                                <div class="artsinput">
                                    <input type="email" id="email" name="email" placeholder="Email" value="{{old('email') ?? ''}}"
                                    class="arts-control @error('email') border border-danger @enderror" style="margin-bottom: 0;"/>
                                    @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="loginbtn mt-4">
                                    <button type="submit" class="btngreen">Get Link</button>
                                </div>
                            </form>
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
