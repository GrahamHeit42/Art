@extends('frontend.layouts.sidebar')
@section('title','Profile')
@section('content')
    <div id="main">
        <div class="profile-setting">
            <div class="profile-area">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto mr-auto col-lg-9">
                            <div class="profile-wrapper">
                                <div id="faq" class="profile-group">
                                    <div class="profile profile-default profile-my-account">

                                        <div class="profile-heading">
                                            <h3 class="profile-title">
                                                <span>1 .</span>
                                                <a data-toggle="collapse" data-parent="#faq" href="#my-account-1"
                                                   aria-expanded="false" class="collapsed">Edit your account information
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="my-account-1" class="profile-collapse collapse show">
                                            <form action="{{url('profile')}}" method="POST">
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
                                                                    <input id="display_name" class="clr-grey"
                                                                           type="text" name="display_name"
                                                                           value="{{$user->display_name}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="change-info">
                                                                    <label>User Name</label>
                                                                    <input id="username" class="clr-grey" type="text"
                                                                           name="username" value="{{$user->username}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="change-info">
                                                                    <label>Email Address</label>
                                                                    <input id="email" class="clr-grey no-cursor"
                                                                           type="email" name="email"
                                                                           value="{{$user->email}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="change-back-btn">
                                                            <div class="profile-btn">
                                                                <button type="submit"
                                                                        class="btn gallery-btn-dark-yellow">Update
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
                                                <a data-toggle="collapse" data-parent="#faq" href="#my-account-2"
                                                   class="collapsed" aria-expanded="false">Change your password
                                                </a>
                                            </h3>
                                        </div>
                                        <div id="my-account-2" class="profile-collapse collapse">
                                            <form action="{{url('change-password')}}" method="POST">
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
                                                                    <input id="old_password" class="" type="password"
                                                                           name="old_password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="change-info">
                                                                    <label>New Password</label>
                                                                    <input id="password" class="" type="password"
                                                                           name="password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="change-info">
                                                                    <label>Password Confirm</label>
                                                                    <input type="password" id="confirm_password"
                                                                           class="" type="password"
                                                                           name="confirm_password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="change-back-btn">
                                                            <div class="profile-btn">
                                                                <button type="submit"
                                                                        class="btn gallery-btn-dark-yellow">Update
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
