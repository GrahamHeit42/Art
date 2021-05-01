@extends('frontend.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="login-register">
        <div class="container">
            <div class="row">
                <div class="login-register-area">
                    <div class="col-md-12 no-spacing">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav" id="contact-us" role="tablist">
                                <a class="active" id="contact-us-tab" data-toggle="tab" href="#contact-us" role="tab"
                                   aria-controls="login" aria-selected="true">
                                    <h4>Contact US</h4>
                                </a>
                            </div>
                            <div class="tab-content" id="contact-us-content">
                                <div class="tab-pane fade show active" id="login" role="tabpanel"
                                     aria-labelledby="login-tab">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="{{ url('contact-us') }}" method="post">
                                                @csrf
                                                <input id="name" title="Your Name" type="text" name="name"
                                                       value="{{ old('name') ?? NULL }}" placeholder="Your Name"
                                                       autofocus />
                                                <input id="email" title="Email Address" type="email" name="email"
                                                       value="{{ old('email') ?? NULL }}" placeholder="Email Address"/>
                                                <input id="phone" title="Your Name" type="text" name="phone"
                                                       value="{{ old('phone') ?? NULL }}" placeholder="Your Phone Number"/>
                                                <input id="message" title="Your Name" type="text" name="message"
                                                       value="{{ old('message') ?? NULL }}" placeholder="Your Query"/>
                                                <div class="button-box">
                                                    <div class="button-box">
                                                        <button type="submit" class="btn gallery-btn-green">
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
                </div>
            </div>
        </div>
    </div>
@endsection
