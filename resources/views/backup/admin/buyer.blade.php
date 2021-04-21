@extends('layouts.sidebar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    @if(isset($buyer))
                    <h3 class="card-title">Update Buyer Details</h3>
                    @else
                    <h3 class="card-title">Add Buyer Details</h3>
                    @endif
                </div>

                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('buyersave') }}">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$buyer->id ?? ''}}" />
                    <input type="hidden" name="role_id" id="role_id" value="3" />
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row col-md-12">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{$buyer->name ?? old('name') ?? ''}}" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" />
                                    <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="number" name="phone" value="{{$buyer->phone ?? old('phone') ?? ''}}" class="form-control {{ $errors->has('phone') ? 'border-danger' : ''}}" />
                                    <small class="form-text text-danger">{!! $errors->first('phone') !!}</small>
                                </div>
                            </div>
                            <!-- </div>
                        <div class="row"> -->
                            <div class="form-group row col-md-12">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{$buyer->email ?? old('email') ?? ''}}" class="form-control {{ $errors->has('email') ? 'border-danger' : ''}}" @if(isset($buyer->email)) readonly @endif/>
                                    <small class="form-text text-danger">{!! $errors->first('email') !!}</small>
                                </div>
                            </div>
                            @if(!isset($buyer))
                            <div class="form-group row col-md-12">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="" class="form-control {{ $errors->has('password') ? 'border-danger' : ''}}" />
                                    <small class="form-text text-danger">{!! $errors->first('password') !!}</small>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row col-md-12">
                                <label for="is_active" class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-10">
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1" <?php if (isset($buyer) && $buyer->is_active == '1') echo "selected='selected'";; ?>>Active</option>
                                        <option value="0" <?php if (isset($buyer) && $buyer->is_active == '0') echo "selected='selected'";; ?>>Inactive</option>
                                    </select>
                                    <small class="form-text text-danger">{!! $errors->first('is_active') !!}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('buyerlist')}}"><input type="button" value="Back" class="btn btn-info float" /></a>
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