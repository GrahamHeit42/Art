@extends('admin.layouts.app')

@push('styles')
<style>
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid"
                                        src="{{ ($user->profile_image != NULL) ? asset($user->profile_image) : asset("assets/images/user.png") }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $user->display_name }}</h3>

                                <p class="text-muted text-center">{{ $user->username }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b>
                                        <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b>
                                        <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Posts</b>
                                        <a class="float-right">13</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Likes</b>
                                        <a class="float-right">127</a>
                                    </li>
                                </ul>

                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            {{--<div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>--}}

                            <div class="card-body">
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted">{{ $user->email }}</p>
                                <hr>

                                <strong><i class="fas fa-lock-open mr-1"></i> Last Login At</strong>
                                <p class="text-muted">
                                    {{ !empty($user->last_login_at) ? $user->last_login_at->format("M d, Y g:i A") : 'N/A' }}
                                </p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Registered At</strong>
                                <p class="text-muted">{{ $user->created_at->format("M d, Y g:i A") }}</p>
                                <hr>

                                <strong><i class="fas fa-info-circle mr-1"></i> Status</strong>
                                <p class="text-muted">{{ $user->status_text }}</p>
                                {{--<hr>--}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped w-100" id="users-table"
                                style="border: 1px solid #dee2e6 !important;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->usernames as $username)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                    <td>{{$username->username}}</td>
                    <td>{{$username->createdBy->username}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>
</div>
</div>
@endsection
