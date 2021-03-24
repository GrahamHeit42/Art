@extends('layouts.sidebar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profile Details</h3>
                </div>

                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('profilesave') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$user->id ?? ''}}" />
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row col-md-12">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" value="{{$user->name ?? old('name') ?? ''}}" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" />
                                    @if(!empty($errors->first('name')))
                                    <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" name="phone" value="{{$user->phone ?? old('phone') ?? ''}}" class="form-control {{ $errors->has('phone') ? 'border-danger' : ''}}" />
                                    @if(!empty($errors->first('phone')))
                                    <small class="form-text text-danger">{!! $errors->first('phone') !!}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{$user->email ?? old('email') ?? ''}}" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" readonly />
                                    @if(!empty($errors->first('email')))
                                    <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
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
@endsection