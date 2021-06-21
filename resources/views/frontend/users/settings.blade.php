@extends('frontend.layouts.app')
@section('title','Profile')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
@section('content')
<div id="main" style="padding-top: 4%;">
    <div class="profile-setting">
        @if(!empty($user->profile_image_url))
        <div class="col-md-12 text-center mb-4">
            <img src="{{$user->profile_image_url}}" class="displayImage" />
        </div>
        @endif
        <div class="profile-area">
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-lg-9">
                        <div class="profile-wrapper">
                            <div id="faq" class="profile-group">
                                <div class="profile profile-default profile-my-account">

                                    <div class="profile-heading">
                                        <h3 class="profile-title">
                                            <span>1 .</span>
                                            <a data-bs-toggle="collapse" data-bs-parent="#faq" href="#my-account-1"
                                                aria-expanded="false" class="collapsed">Edit your account information
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="my-account-1"
                                        class="profile-collapse collapse @if(empty(old('old_password'))) show @endif">
                                        <form action="{{ url('settings') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="profile-body">
                                                <div class="profile-info-wrapper">
                                                    <div class="account-wrapper">
                                                        <h4>My Account Information</h4>
                                                        <h5>Your Personal Details</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="change-info">
                                                                <label>Display Name</label>
                                                                <input id="display_name" class="clr-grey" type="text"
                                                                    name="display_name" value="{{$user->display_name}}">
                                                                @error('display_name')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="change-info">
                                                                <label>User Name</label>
                                                                <input id="username" class="clr-grey" type="text"
                                                                    name="username" value="{{$user->username}}">
                                                                @error('username')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="change-info">
                                                                <label>Email Address</label>
                                                                <input id="email" class="clr-grey no-cursor"
                                                                    type="email" name="email" value="{{$user->email}}"
                                                                    readonly>
                                                                @error('email')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="change-info">
                                                                <label>Profile Image</label>
                                                                <input type="file" name="profile_image"
                                                                    accept="image/*" />
                                                                @error('profile_image')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="change-back-btn">
                                                        <div class="profile-btn">
                                                            <button type="submit" class="btn btndarkyellow">Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class=" profile profile-default profile-my-account">
                                    <div class="profile-heading">
                                        <h3 class="profile-title"><span>2 .</span>
                                            <a data-bs-toggle="collapse" data-bs-parent="#faq" href="#my-account-2"
                                                class="collapsed" aria-expanded="false">Change your password
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="my-account-2"
                                        class="profile-collapse collapse @if(!empty(old('old_password'))) show @endif">
                                        <form action="{{ url('change-password') }}" method="POST">
                                            @csrf
                                            <div class="profile-body">
                                                <div class="profile-info-wrapper">
                                                    <div class="account-wrapper">
                                                        <h4>Change Password</h4>
                                                        <h5>Your Password</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="change-info">
                                                                <label>Old Password</label>
                                                                <input id="old_password" type="password"
                                                                    name="old_password" required />
                                                                @error('old_password')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="change-info">
                                                                <label>New Password</label>
                                                                <input id="password" type="password" name="password"
                                                                    required />
                                                                @error('password')
                                                                <span class="small text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="change-info">
                                                                <label>Confirm Password</label>
                                                                <input type="password" id="password_confirmation"
                                                                    class="" type="password"
                                                                    name="password_confirmation" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="change-back-btn">
                                                        <div class="profile-btn">
                                                            <button type="submit" class="btn btndarkyellow">Update
                                                            </button>
                                                        </div>
                                                    </div>
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
