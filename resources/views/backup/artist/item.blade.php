@extends('layouts.sidebar')
@section('head-part')
<style>
    img {
        display: inline;
        position: relative;
        width: 50%;
        height: auto;
    }

    .dlt-btn {
        position: absolute;
        right: 51%;
        top: 0;
        height: 21px;
        width: 21px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    @if(isset($item))
                    <h3 class="card-title">Update Item Details</h3>
                    @else
                    <h3 class="card-title">Add Item Details</h3>
                    @endif
                </div>

                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('itemsave')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{$item->id ?? ''}}" />
                            <div class="form-group row col-md-12">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" value="{{$item->name ?? old('name') ?? ''}}" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" />
                                    @if(!empty($errors->first('name')))
                                    <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'border-danger' : ''}}">{{$item->description ?? old('description') ?? ''}}</textarea>
                                    @if(!empty($errors->first('description')))
                                    <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tags" id="tags" value="{{$item->tags ?? old('tags') ?? ''}}" class="form-control {{ $errors->has('tags') ? 'border-danger' : ''}}" />
                                    @if(!empty($errors->first('tags')))
                                    <small class="form-text text-danger">{!! $errors->first('tags') !!}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="path" class="col-sm-2 col-form-label">Upload</label>
                                <div class="col-sm-10">
                                    @if(isset($item) && !empty($item->path))
                                    <img src="{{$item->path}}" width="50" />
                                    <button type="button" class="btn open-modal dlt-btn" data-id="{{$item->id}}"><i class="fas fa-trash"></i></button>
                                    @else
                                    <input type="file" name="path" id="path" />
                                    <small class="form-text text-danger">{!! $errors->first('path') !!}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('itemlist')}}"><input type="button" value="Back" class="btn btn-info float" /></a>
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
    $(document).ready(function() {
        $(".dlt-btn").click(function() {
            var id = $(this).data("id");

            $.ajax({
                url: "/itemimgdlt/" + id,
                type: 'post',
                data: {
                    "id": id,
                },
                success: function() {
                    window.location.reload();
                },
                error: function(xhr) {
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
@endsection