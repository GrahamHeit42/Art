@extends('frontend.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="login-register">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="loginregistertext">Contact US</h2>
                <div class="login-registerwrapper">
                    <div class="login-register-form">
                        <form action="{{ url('contact-us') }}" method="post">
                            @csrf
                            <div class="artsinput">
                                <input id="name" title="Your Name" type="text" name="name" value="{{ old('name') ?? NULL }}"
                                    placeholder="Your Name" autofocus class="arts-control @error('name') border border-danger @enderror" style="margin-bottom: 0;"/>
                                    @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="artsinput">
                                <input id="email" title="Email Address" type="email" name="email" value="{{ old('email') ?? NULL }}"
                                    placeholder="Email Address" class="mt-4 arts-control @error('email') border border-danger @enderror" style="margin-bottom: 0;"/>
                                    @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="artsinput">
                                <input id="phone" title="Your Name" type="text" name="phone" value="{{ old('phone') ?? NULL }}"
                                    placeholder="Your Phone Number" class="mt-4 arts-control @error('phone') border border-danger @enderror" style="margin-bottom: 0;"/>
                                    @error('phone')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="artsinput">
                                <input id="message" title="Your Name" type="text" name="message" value="{{ old('message') ?? NULL }}"
                                    placeholder="Your Query" class="mt-4 arts-control @error('message') border border-danger @enderror" style="margin-bottom: 0;"/>
                                    @error('message')
                                <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="button-box mt-4">
                                <div class="button-box">
                                    <button type="submit" class="btndarkyellow">
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
