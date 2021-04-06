@extends('admin.layouts.sidebar')
@section('title','Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        @if(isset($usersCount))
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$usersCount}}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('usersList')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        @endif
        <!-- end -->
    </div>
</div>
@endsection