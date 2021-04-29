@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ !empty($user->id ?? NULL) ? 'Update' : 'Create New' }} User</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form name="user-form" id="user-form" action="{{ url('admin/users/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input hidden id="user_id" name="id" value="{{ $user->id ?? NULL }}" />
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="display_name">Display Name</label>
                                    <input type="text" id="display_name" name="display_name" class="form-control"
                                           value="{{ $user->display_name ?? NULL }}" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                           value="{{ $user->username ?? NULL }}" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                           value="{{ $user->email ?? NULL }}" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="status">Status</label><br>
                                    <label>
                                        <input type="radio" id="status-inactive" name="status"
                                               value="0" {{ ($user->status ?? 0) === 0 ? 'checked' : '' }}/> Inactive
                                    </label>
                                    <label class="ml-3">
                                        <input type="radio" id="status-active" name="status"
                                               value="1" {{ ($user->status ?? 0) === 1 ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="ml-3">
                                        <input type="radio" id="status-blocked" name="status"
                                               value="2" {{ ($user->status ?? 0) === 2 ? 'checked' : '' }}> Blocked
                                    </label>
                                </div>
                            </div>
                        </div>

                        <a type="button" href="{{ url('admin/users') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success ml-3">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
