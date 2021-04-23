@extends('admin.layouts.sidebar')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        @if(isset($user))
                            <h3 class="card-title">Update User Details</h3>
                        @else
                            <h3 class="card-title">Add User Details</h3>
                        @endif
                    </div>

                    <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('users/save') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{$user->id ?? ''}}" />
                        <input type="hidden" name="role_id" id="role_id" value="2" />
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group row col-md-12">
                                    <label for="profile_image" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        @if(isset($user->profile_image) && !empty($user->profile_image))
                                            <img src="{{$user->profile_image}}" width="100" height="100" />
                                            <button type="button" class="btn open-modal dlt-btn"
                                                    data-id="{{$user->id}}"><i class="fas fa-trash"></i></button>
                                        @else
                                            <input type="file" name="profile_image" id="profile_image" />
                                        @endif
                                        <small
                                            class="form-text text-danger">{!! $errors->first('profile_image') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="display_name" class="col-sm-2 col-form-label">Display Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="display_name" id="display_name"
                                               value="{{$user->display_name ?? old('display_name') ?? ''}}"
                                               class="form-control {{ $errors->has('display_name') ? 'border-danger' : ''}}" />
                                        <small
                                            class="form-text text-danger">{!! $errors->first('display_name') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="username" class="col-sm-2 col-form-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" id="username"
                                               value="{{$user->username ?? old('username') ?? ''}}"
                                               class="form-control {{ $errors->has('username') ? 'border-danger' : ''}}" />
                                        <small class="form-text text-danger">{!! $errors->first('username') !!}</small>
                                    </div>
                                </div>

                                <div class="form-group row col-md-12">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{$user->email ?? old('email') ?? ''}}"
                                               class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}"
                                               @if(isset($user->email)) readonly @endif />
                                        <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                                    </div>
                                </div>
                                @if(!isset($user))
                                    <div class="form-group row col-md-12">
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" value=""
                                                   class="form-control {{ $errors->has('password') ? 'border-danger' : ''}}" />
                                            <small
                                                class="form-text text-danger">{!! $errors->first('password') !!}</small>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row col-md-12">
                                    <label for="is_admin" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="is_admin" id="is_admin" class="form-control">
                                            <option
                                                value="1" <?php if (isset($user) && $user->is_admin == '1') echo 'selected=selected'; ?>>
                                                Admin
                                            </option>
                                            <option
                                                value="0" <?php if (isset($user) && $user->is_admin == '0') echo 'selected=selected'; ?>>
                                                User
                                            </option>
                                        </select>
                                        <small class="form-text text-danger">{!! $errors->first('is_admin') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-12">
                                    <label for="status" class="col-sm-2 col-form-label">Active</label>
                                    <div class="col-sm-10">
                                        <select name="status" id="status" class="form-control">
                                            <option
                                                value="0" <?php if (isset($user) && $user->status == '0') echo 'selected=selected'; ?>>
                                                Pending
                                            </option>
                                            <option
                                                value="1" <?php if (isset($user) && $user->status == '1') echo 'selected=selected'; ?>>
                                                Active
                                            </option>
                                            <option
                                                value="2" <?php if (isset($user) && $user->status == '2') echo 'selected=selected'; ?>>
                                                Deleted
                                            </option>
                                            <option
                                                value="3" <?php if (isset($user) && $user->status == '3') echo 'selected=selected'; ?>>
                                                Suspended
                                            </option>

                                        </select>
                                        <small class="form-text text-danger">{!! $errors->first('status') !!}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{url('users')}}"><input type="button" value="Back" class="btn btn-info float" />
                            </a>
                            <button type="submit" class="btn btn-info float-right">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script>
        $(document).ready(function () {
            $(".dlt-btn").click(function () {
                var id = $(this).data("id");

                $.ajax({
                    url: "/user-image-delete/" + id,
                    type: 'post',
                    data: {
                        "id": id,
                    },
                    success: function () {
                        window.location.reload();
                    },
                    error: function (xhr) {
                        window.location.reload();
                    }
                });

            });
        });
    </script>
    @if(session()->has('success'))
        <script type="text/javascript">
            toastr.success('<?php echo session()->get('success'); ?>')
        </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                toastr.error('{{$error}}')
            </script>
        @endforeach
    @endif
@endsection
