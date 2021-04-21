@extends('admin.layouts.sidebar')
@section('title','User')
@section('content')
<!-- <div class="row"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card col-md-9 m-auto">
        @if(isset($user))
        <div class="card-header">
            <h3 class="card-title">User</h3>
            <h3 class="card-title float-right">
                <a href="{{url('/users/update',$user->id)}}" class="btn btn-primary btn-sm" style="border-color: white;"><i class="fas fa-edit" aria-hidden="true" style="padding-right: 5px;"></i>Edit User</a>
            </h3>
        </div>
        <div class="card-body">
            @if(!empty($user->profile_image))
            <div class="form-group row col-md-12">
                <img src="{{$user->profile_image}}" width="100" height="100" class="m-auto br-50p" />
            </div>
            @endif
            <div class="form-group row col-md-12">
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Role</label>
                    <div class="col-sm-8">@if($user->is_admin == 0) End User @else Admin @endif</div>
                </div>
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Status</label>
                    <div class="col-sm-8">
                        <?php
                        if ($user->status == 0) echo '<span class="badge badge-info">Pending</span>';
                        if ($user->status == 1) echo '<span class="badge badge-success">Active</span>';
                        if ($user->status == 2) echo '<span class="badge badge-danger">Deleted</span>';
                        if ($user->status == 3) echo '<span class="badge badge-danger">Suspended</span>';
                        ?>
                    </div>
                </div>
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Name</label>
                    <div class="col-sm-8">{{$user->first_name}} {{$user->last_name}}</div>
                </div>
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Email</label>
                    <div class="col-sm-8">{{$user->email}}</div>
                </div>
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Register At</label>
                    <div class="col-sm-8">{{$user->created_at}}</div>
                </div>
                <div class="form-group row col-md-6">
                    <label class="col-sm-4">Last Login At</label>
                    <div class="col-sm-8">{{$user->last_login_at ?? $user->created_at}}</div>
                </div>

            </div>
        </div>
        @endif
    </div>

</section>
@endsection