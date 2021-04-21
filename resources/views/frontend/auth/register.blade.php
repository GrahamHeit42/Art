@extends('frontend.layouts.sidebar')
@section('title','Register')
@section('page-header')
<style>
    .rounded2r {
        border-radius: 0px 25px 25px 0px;
    }

    input[type=file] {
        display: none;
    }

    .file-upload {
        background-color: grey;
        color: #fff;
        padding: 0.5rem;
        cursor: pointer;
    }

    .login-form-container {
        padding: 40px !important;
    }

    .filename {
        width: 100%;
        text-align: center;
        position: relative;
        display: inline-block;
    }
</style>
@endsection
@section('content')
<div id="main">
    <div class="login-register">
        <div class="container">
            <div class="row">
                <div class="login-register-area">
                    <div class="col-md-12">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav" id="login-register" role="tablist">
                                <a class="active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                                    <h4>Register</h4>
                                </a>
                            </div>
                            <div class="tab-content" id="login-registerContent">
                                <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form enctype="multipart/form-data" action="{{ route('register') }}" method="post">
                                                @csrf
                                                <!-- <div class="form-group mt-4 imgDiv">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input cursor-pointer" id="profile_image" name="profile_image" />
                                                        <label for="profile_image" class="file-upload custom-file-label cursor-pointer">
                                                            <span class="rounded2r">Upload Profile Image</span>
                                                        </label>
                                                    </div>
                                                    <span id="filename" class="filename"></span>
                                                </div> -->
                                                <input id="display_name" class="" type="text" name="display_name" value="{{old('display_name') ?? ''}}" placeholder="Display Name" autofocus />
                                                <input id="username" class="" type="text" name="username" value="{{old('username') ?? ''}}" placeholder="User Name" />
                                                <input id="email" class="" type="email" name="email" value="{{old('email') ?? ''}}" placeholder="Email" />
                                                <input id="password" class="" type="password" name="password" placeholder="Password" />
                                                <input type="password" id="password_confirmation" class="" type="password" name="password_confirmation" placeholder="Confirm Password" />
                                                <div class="button-box">
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
</div>
@endsection
@section('page-footer')
<script>
    $(document).ready(function() {
        $('input[type=file]').change(function() {
            checkImage(this);
        });
    });

    function checkImage(input) {
        if (input.files && input.files[0]) {
            var filename = $('input[type=file]').val().split('\\').pop();
            $("#filename").html(filename);
        }
    }
</script>
@endsection