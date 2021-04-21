@extends('admin.layouts.sidebar')
@section('title','Sample')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
            <h3 class="card-title float-right">
                <a href="{{url('/users/create')}}" class="btn btn-primary btn-sm" style="border-color: white;"><i class="fa fa-plus-circle" aria-hidden="true" style="padding-right: 5px;"></i>New User</a>
            </h3>
        </div>
        <div class="card-body">

        </div>
    </div>

</section>
@endsection