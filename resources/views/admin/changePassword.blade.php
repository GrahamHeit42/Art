@extends('admin.layouts.sidebar')
@section('title','Change Password')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Change Password</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card col-md-9 m-auto">
        <div class="card-header">
            <h3 class="card-title">Change Password</h3>
        </div>
        <div class="card-body">

            <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('change-password') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row col-md-12">
                            <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="old_password" value="" class="form-control {{ $errors->has('old_password') ? 'border-danger' : ''}}" />
                                @if(!empty($errors->first('old_password')))
                                <small class="form-text text-danger">{!! $errors->first('old_password') !!}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <label for="password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" value="" class="form-control {{ $errors->has('password') ? 'border-danger' : ''}}" />
                                @if(!empty($errors->first('password')))
                                <small class="form-text text-danger">{!! $errors->first('password') !!}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="confirm_password" value="" class="form-control {{ $errors->has('confirm_password') ? 'border-danger' : ''}}" />
                                @if(!empty($errors->first('confirm_password')))
                                <small class="form-text text-danger">{!! $errors->first('confirm_password') !!}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info float-right">Save</button>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection