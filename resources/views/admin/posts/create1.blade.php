@extends('admin.layouts.sidebar')
@section('title','New Post')
@section('head-part')
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    @if(isset($post))
                    <h3 class="card-title">Update Post Details</h3>
                    @else
                    <h3 class="card-title">Add Post Details</h3>
                    @endif
                </div>

                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('posts/save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$post->id ?? ''}}" />
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row col-md-6">
                                <label for="user_id" class="col-sm-4 col-form-label">User</label>
                                <div class="col-sm-8">
                                    @if(isset($users) && !empty($users))
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->display_name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <small class="form-text text-danger">{!! $errors->first('user_id') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-6">
                                <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                                <div class="col-sm-10">
                                    @if(isset($post->image) && !empty($post->image))
                                    <img src="{{$post->image}}" width="100" height="100" />
                                    <button type="button" class="btn open-modal dlt-btn" data-id="{{$post->id}}"><i class="fas fa-trash"></i></button>
                                    @else
                                    <input type="file" name="image" id="image" />
                                    @endif
                                    <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-6">
                                <label for="name" class="col-sm-4 col-form-label">Commissioned By / Drawn By</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" value="{{$post->name ?? old('name') ?? ''}}" class="form-control {{ $errors->has('name') ? 'border-danger' : ''}}" />
                                    <small class="form-text text-danger">{!! $errors->first('name') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-6">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title" value="{{$post->title ?? old('title') ?? ''}}" class="form-control {{ $errors->has('title') ? 'border-danger' : ''}}" />
                                    <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'border-danger' : ''}}" rows="3">{{old('description') ?? ''}}</textarea> <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label class="col-sm-2 col-form-label">Rating as : </label>
                                <div class="col-sm-10">
                                    <input type="radio" name="type" id="type" value="artist" checked class="m-7p" />Artist
                                    <input type="radio" name="type" id="type" value="buyer" class="m-7p" />Buyer
                                </div>
                            </div>

                            <div id="getForm1" class="form-group row col-md-12 ">
                                <div class="form-group row col-md-6">
                                    <label for="transaction" class="col-sm-4 col-form-label">Transaction</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="transaction" id="rating1-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating1-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="transaction" id="rating1-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating1-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="transaction" id="rating1-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating1-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="transaction" id="rating1-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating1-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="transaction" id="rating1-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating1-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="transaction" id="rating1-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('transaction') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="speed_a" class="col-sm-4 col-form-label">Speed</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="speed_a" id="rating2-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating2-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_a" id="rating2-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating2-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_a" id="rating2-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating2-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_a" id="rating2-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating2-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_a" id="rating2-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating2-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_a" id="rating2-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('speed_a') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="communication_a" class="col-sm-4 col-form-label">Communication</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="communication_a" id="rating3-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating3-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_a" id="rating3-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating3-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_a" id="rating3-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating3-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_a" id="rating3-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating3-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_a" id="rating3-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating3-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_a" id="rating3-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('communication') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="prepertion" class="col-sm-4 col-form-label">Prepertion</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="prepertion" id="rating4-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating4-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="prepertion" id="rating4-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating4-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="prepertion" id="rating4-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating4-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="prepertion" id="rating4-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating4-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="prepertion" id="rating4-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating4-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="prepertion" id="rating4-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('prepertion') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="concept" class="col-sm-4 col-form-label">Concept</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="concept" id="rating5-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating5-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="concept" id="rating5-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating5-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="concept" id="rating5-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating5-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="concept" id="rating5-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating5-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="concept" id="rating5-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating5-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="concept" id="rating5-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('concept') !!}</small>
                                    </div>
                                </div>
                            </div>
                            <div id="getForm2" class="form-group row col-md-12 ">
                                <div class="form-group row col-md-6">
                                    <label for="price" class="col-sm-4 col-form-label">Price</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="price" id="rating6-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating6-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="price" id="rating6-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating6-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="price" id="rating6-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating6-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="price" id="rating6-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating6-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="price" id="rating6-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating6-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="price" id="rating6-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('price') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="speed_b" class="col-sm-4 col-form-label">Speed</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="speed_b" id="rating7-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating7-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_b" id="rating7-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating7-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_b" id="rating7-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating7-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_b" id="rating7-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating7-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_b" id="rating7-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating7-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="speed_b" id="rating7-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('speed_b') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="quality" class="col-sm-4 col-form-label">Quality</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="quality" id="rating8-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating8-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="quality" id="rating8-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating8-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="quality" id="rating8-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating8-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="quality" id="rating8-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating8-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="quality" id="rating8-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating8-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="quality" id="rating8-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('quality') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="professonalism" class="col-sm-4 col-form-label">Professonalism</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="professonalism" id="rating9-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating9-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="professonalism" id="rating9-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating9-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="professonalism" id="rating9-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating9-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="professonalism" id="rating9-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating9-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="professonalism" id="rating9-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating9-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="professonalism" id="rating9-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('professonalism') !!}</small>
                                    </div>
                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="communication_b" class="col-sm-4 col-form-label">Communication</label>
                                    <div class="col-sm-8">
                                        <div id="full-stars-example-two">
                                            <div class="rating-group">
                                                <input disabled checked class="rating__input rating__input--none" name="communication_b" id="rating10-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating10-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_b" id="rating10-1" value="1" type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating10-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_b" id="rating10-2" value="2" type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating10-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_b" id="rating10-3" value="3" type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating10-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_b" id="rating10-4" value="4" type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating10-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="communication_b" id="rating10-5" value="5" type="radio">
                                            </div>
                                        </div>
                                        <small class="form-text text-danger">{!! $errors->first('communication_b') !!}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row col-md-6">
                                <label for="again" class="col-sm-6 col-form-label">Would you like to work again?</label>
                                <div class="col-sm-6">
                                    <select name="again" id="again" class="form-control">
                                        <option value="1" <?php if (isset($post) && $post->again == '1') echo 'selected=selected'; ?>>Yes</option>
                                        <option value="0" <?php if (isset($post) && $post->again == '0') echo 'selected=selected'; ?>>No</option>
                                    </select>
                                    <small class="form-text text-danger">{!! $errors->first('again') !!}</small>
                                </div>
                            </div>
                            <div class="form-group row col-md-6">
                                <label for="status" class="col-sm-2 col-form-label">Active</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" <?php if (isset($post) && $post->status == '1') echo 'selected=selected'; ?>>Active</option>
                                        <option value="0" <?php if (isset($post) && $post->status == '0') echo 'selected=selected'; ?>>Inactive</option>
                                    </select>
                                    <small class="form-text text-danger">{!! $errors->first('status') !!}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('posts')}}"><input type="button" value="Back" class="btn btn-info float" /></a>
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

        if ($('input[type=radio][name=type]').val() == 'artist') {
            $("#getForm1").show();
            $("#getForm2").hide();
        } else {
            $("#getForm1").hide();
            $("#getForm2").show();
        }
        $('input[type=radio][name=type]').change(function() {
            if (this.value == 'artist') {
                $("#getForm1").show();
                $("#getForm2").hide();
            } else if (this.value == 'buyer') {
                $("#getForm1").hide();
                $("#getForm2").show();
            }
        });
        $(".dlt-btn").click(function() {
            var id = $(this).data("id");

            $.ajax({
                url: "/postImageDelete/" + id,
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
@if ($errors->any())
@foreach ($errors->all() as $error)
<script type="text/javascript">
    toastr.error('{{$error}}')
</script>
@endforeach
@endif
@endsection
