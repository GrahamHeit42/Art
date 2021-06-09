@extends('admin.layouts.app')

@push('stylesheets')
<style>
    .table-bordered {
        border: 1px solid #dee2e6 !important;
    }
</style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(isset($user))
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="@if($user->profile_image_url != NULL) {{$user->profile_image_url}} @else {{asset('assets/images/user.png')}} @endif"
                                alt="Image">
                        </div>

                        <h3 class="profile-username text-center">{{$user->display_name ?? ''}}</h3>

                        <p class="text-muted text-center">{{$user->username ?? ''}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a
                                    class="float-right">{{(!empty($user->followers) ? $user->followers : 0)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a
                                    class="float-right">{{(!empty($user->following) ? $user->following : 0)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Posts</b> <a
                                    class="float-right">{{(!empty($user->posts) ? $user->posts->count() : 0)}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Likes</b> <a
                                    class="float-right">{{(!empty($user->likes_count) ? $user->likes_count : 0)}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal-info"
                                    data-toggle="tab">Personal Info</a></li>
                            <li class="nav-item"><a class="nav-link" href="#posts" data-toggle="tab">Posts</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal-info">
                                <div class="post">
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Display Name</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$user->display_name}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Username</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$user->username}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Email</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Last Login At</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">
                                                    {{date("M d,Y",strtotime($user->last_login_at))}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="posts">
                                <!-- The timeline -->
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-striped w-100" id="posts-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Cover Image</th>
                                                <th>Title</th>
                                                <th>Subject</th>
                                                <th>Medium</th>
                                                <th>Count</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($user->posts))
                                            @foreach ($user->posts as $post)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td style="text-align: center"><img class="img-thumbnail"
                                                        src="{{(!empty($post->cover_image)) ? $post->image_url : asset('assets/images/noimage.jpg')}}"
                                                        width="50" height="50" /></td>
                                                <td>{{$post->title}}</td>
                                                <td>{{$post->subject->title}}</td>
                                                <td>{{$post->medium->title}}</td>
                                                <td><span><i
                                                            class="far fa-thumbs-up text-primary"></i>{{$post->likes->count()}}</span><span><i
                                                            class="fa fa-eye text-info"></i>{{$post->views->count()}}</span><span><i
                                                            class="fa fa-comment text-success"></i>{{$post->comments->count()}}</span>
                                                </td>
                                                <td><a href="{{url('admin/posts/'.$post->id)}}"
                                                        class="btn btn-lg text-info p-2"><i class="fas fa-eye"></i> </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">

                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        @endif
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@push('scripts')
@endpush
