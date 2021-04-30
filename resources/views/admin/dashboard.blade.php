@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $summary['users'] ?? 0 }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="{{ url('admin/users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $summary['subjects'] ?? 0 }}</h3>

                        <p>Subjects</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ url('admin/subjects') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $summary['mediums'] ?? 0 }}</h3>

                        <p>Mediums</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-paper-outline"></i>
                    </div>
                    <a href="{{ url('admin/mediums') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $summary['posts'] ?? 0 }}</h3>

                        <p>Posts</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ url('admin/posts') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
@endsection
