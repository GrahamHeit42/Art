@extends('admin.layouts.sidebar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>

                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('change-password-save') }}">
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
    </div>
</div>
@endsection
@section('page-script')
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