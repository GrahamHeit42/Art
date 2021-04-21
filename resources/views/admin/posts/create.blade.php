@extends('admin.layouts.sidebar')
@section('title','Post')
@section('head-part')
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<style>
    .dropzone {
        border: 1px transparent lightgray;
        padding: 30px;
        cursor: pointer;
        border-radius: 20px;
    }

    input[type=radio] {
        margin-left: 5px;
        margin-right: 5px;
    }
</style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Post</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/posts')}}">Posts</a></li>
                    <li class="breadcrumb-item active">Post</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card col-md-11 m-auto">
        <div class="card-header">
            <h3 class="card-title">Post</h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('posts/save') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="id" value="{{$post->id ?? ''}}" />
                <div class="card-body">
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-3 col-form-label">I am an : </label>
                            <div class="col-sm-9 col-form-label">
                                <input type="radio" name="user_type" id="user_type" value="1" class="m-7p" />Artist
                                <input type="radio" name="user_type" id="user_type" value="2" class="m-7p" />Commissioner
                            </div>
                        </div>
                        <div class="form-group row col-md-6" id="getArtistType">
                            <label class="col-sm-4 col-form-label">Upload will be : </label>
                            <div class="col-sm-8 col-form-label">
                                <input type="radio" name="artist_type" id="artist_type" value="1" class="m-7p" />Personal
                                <input type="radio" name="artist_type" id="artist_type" value="2" class="m-7p" />Commissioned
                            </div>
                        </div>

                        <div id="getForm" class="form-group row col-md-12">
                            <div id="leftPortion" class="form-group col-md-6 ">
                                <div class="form-group col-md-12">
                                    <div class="dropzone" id="dropzoneFileUpload">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="button" id="uploadPhoto" class="col-md-12 btn btn-small btn-primary">Upload Images</button>
                                    <small class="form-text text-danger">{!! $errors->first('images') !!}</small>
                                </div>
                            </div><!-- first portion -->
                            <div class="form-group row col-md-6">
                                <div class="form-group col-md-12">
                                    <div id="usersPortion" class="col-md-12">
                                        @if(isset($users) && !empty($users))
                                        <select name="user_id" id="user_id" class="form-control ">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                        <small class="form-text text-danger">{!! $errors->first('user_id') !!}</small>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <div id="subjectsPortion" class="col-md-6">
                                            @if(isset($subjects) && !empty($subjects))
                                            <select name="subject_id" id="subject_id" class="form-control ">
                                                <option value="" disabled selected>--Select Subject--</option>
                                                @foreach($subjects as $subject)
                                                <option value="{{$subject->id}}">{{$subject->type}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            <small class="form-text text-danger">{!! $errors->first('subject_id') !!}</small>
                                        </div>
                                        <div id="mediumsPortion" class="col-md-6">
                                            @if(isset($mediums) && !empty($mediums))
                                            <select name="medium_id" id="medium_id" class="form-control ">
                                                <option value="" disabled selected>--Select Medium--</option>
                                                @foreach($mediums as $medium)
                                                <option value="{{$medium->id}}">{{$medium->type}}</option>
                                                @endforeach
                                            </select>
                                            @endif
                                            <small class="form-text text-danger">{!! $errors->first('medium_id') !!}</small>
                                        </div>
                                    </div>
                                    <div id="titlePortion" class="col-md-12">
                                        <input type="text" name="title" id="title" value="" placeholder="Title" class="form-control col-md-12 " />
                                        <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                                    </div>
                                    <div id="descriptionPortion" class="col-md-12">
                                        <textarea id="description" name="description" class="form-control col-md-12 " rows="4" placeholder="Note"></textarea>
                                        <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                                    </div>
                                    <div id="keywordsPortion" class="col-md-12">
                                        <input type="text" name="keywords" id="keywords" value="" placeholder="Keywords separated by spaces" class="form-control col-md-12 " />
                                        <small class="form-text text-danger">{!! $errors->first('keywords') !!}</small>
                                    </div>
                                    <div id="a_ReviewPortion" class="col-md-12">
                                        <div class="form-group row col-md-12">
                                            <label for="a_transaction" class="col-sm-5 col-form-label pl-0">Transaction</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="a_transaction" id="a_transaction-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="a_transaction-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_transaction" id="a_transaction-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="a_transaction-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_transaction" id="a_transaction-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="a_transaction-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_transaction" id="a_transaction-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="a_transaction-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_transaction" id="a_transaction-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="a_transaction-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_transaction" id="a_transaction-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('a_transaction') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="a_concept" class="col-sm-5 col-form-label pl-0">Concept</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="a_concept" id="a_concept-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="a_concept-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_concept" id="a_concept-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="a_concept-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_concept" id="a_concept-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="a_concept-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_concept" id="a_concept-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="a_concept-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_concept" id="a_concept-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="a_concept-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_concept" id="a_concept-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('a_concept') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="a_understanding" class="col-sm-5 col-form-label pl-0">Understanding</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="a_understanding" id="a_understanding-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="a_understanding-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_understanding" id="a_understanding-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="a_understanding-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_understanding" id="a_understanding-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="a_understanding-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_understanding" id="a_understanding-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="a_understanding-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_understanding" id="a_understanding-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="a_understanding-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_understanding" id="a_understanding-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('a_understanding') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="a_communication" class="col-sm-5 col-form-label pl-0">Communication</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="a_communication" id="a_communication-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="a_communication-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_communication" id="a_communication-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="a_communication-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_communication" id="a_communication-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="a_communication-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_communication" id="a_communication-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="a_communication-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_communication" id="a_communication-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="a_communication-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="a_communication" id="a_communication-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('a_communication') !!}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="c_ReviewPortion" class="col-md-12">
                                        <div class="form-group row col-md-12">
                                            <label for="c_price" class="col-sm-5 col-form-label pl-0">Price</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="c_price" id="c_price-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="c_price-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_price" id="c_price-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="c_price-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_price" id="c_price-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="c_price-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_price" id="c_price-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="c_price-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_price" id="c_price-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="c_price-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_price" id="c_price-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('c_price') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="c_speed" class="col-sm-5 col-form-label pl-0">Speed</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="c_speed" id="c_speed-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="c_speed-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_speed" id="c_speed-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="c_speed-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_speed" id="c_speed-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="c_speed-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_speed" id="c_speed-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="c_speed-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_speed" id="c_speed-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="c_speed-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_speed" id="c_speed-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('c_speed') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="c_quality" class="col-sm-5 col-form-label pl-0">Quality</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="c_quality" id="c_quality-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="c_quality-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_quality" id="c_quality-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="c_quality-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_quality" id="c_quality-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="c_quality-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_quality" id="c_quality-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="c_quality-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_quality" id="c_quality-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="c_quality-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_quality" id="c_quality-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('c_quality') !!}</small>
                                            </div>
                                        </div>
                                        <div class="form-group row col-md-12">
                                            <label for="c_communication" class="col-sm-5 col-form-label pl-0">Communication</label>
                                            <div class="col-sm-7">
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        <input disabled checked class="rating__input rating__input--none" name="c_communication" id="c_communication-none" value="0" type="radio">
                                                        <label aria-label="1 star" class="rating__label" for="c_communication-1">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_communication" id="c_communication-1" value="1" type="radio">
                                                        <label aria-label="2 stars" class="rating__label" for="c_communication-2">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_communication" id="c_communication-2" value="2" type="radio">
                                                        <label aria-label="3 stars" class="rating__label" for="c_communication-3">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_communication" id="c_communication-3" value="3" type="radio">
                                                        <label aria-label="4 stars" class="rating__label" for="c_communication-4">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_communication" id="c_communication-4" value="4" type="radio">
                                                        <label aria-label="5 stars" class="rating__label" for="c_communication-5">
                                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                        </label>
                                                        <input class="rating__input" name="c_communication" id="c_communication-5" value="5" type="radio">
                                                    </div>
                                                </div>
                                                <small class="form-text text-danger">{!! $errors->first('c_communication') !!}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="workAgainPortion" class="col-md-12 ">
                                        <label for="work_again" class="col-form-label">
                                            Would you like to work again with <span id="setUser"></span>?</label>
                                        <input type="radio" name="work_again" id="work_again" value="1" />Yes
                                        <input type="radio" name="work_again" id="work_again" value="0" />No
                                        <small class="form-text text-danger">{!! $errors->first('work_again') !!}</small>
                                    </div>
                                    <input type="hidden" name="status" value="1" />
                                </div>
                            </div><!-- second portion -->
                        </div><!-- getForm div -->

                    </div><!-- row -->
                </div> <!-- card-body -->
                <div class="card-footer">
                    <a href="{{url('posts')}}"><input type="button" value="Back" class="btn btn-info float" /></a>
                    <button type="submit" class="btn btn-info float-right">Save</button>
                </div>

            </form>
        </div>
    </div>

</section>
@endsection
@section('page-script')
<script type="text/javascript">
    var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: "{{url('dropzone/store')}}",
            maxFilesize: 5, // MB
            maxFiles: 9,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            autoProcessQueue: false,
            params: {
                _token: "{{csrf_token()}}"
            },
            success: function(file, response) {
                uploadedDocumentMap[file.name] = response.name
            },
            error: function(file, response) {
                console.log(response);
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="images[]"][value="' + name + '"]').remove()
            },

        });

        myDropzone.on("success", function(file, response) {
            if (response.success == true) {
                $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
            } else {
                console.log("Faild to upload image! Try again");
            }
        });

        jQuery("button#uploadPhoto").click(function() {
            myDropzone.processQueue();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#getArtistType").hide();
        $("#leftPortion").hide();
        $("#usersPortion").hide();
        $("#subjectsPortion").hide();
        $("#mediumsPortion").hide();
        $("#titlePortion").hide();
        $("#descriptionPortion").hide();
        $("#keywordsPortion").hide();
        $("#workAgainPortion").hide();
        $("#a_ReviewPortion").hide();
        $("#c_ReviewPortion").hide();

        var constant_ap = "{{config('constants.AP')}}"
        var constant_ac = "{{config('constants.AC')}}"
        var constant_cc = "{{config('constants.CC')}}"

        $('input[type=radio][name=user_type]').change(function() {
            if (this.value == '1') { //artist
                $("#getArtistType").show();
                $("#leftPortion").hide();
                $("#usersPortion").hide();
                $("#subjectsPortion").hide();
                $("#mediumsPortion").hide();
                $("#titlePortion").hide();
                $("#descriptionPortion").hide();
                $("#keywordsPortion").hide();
                $("#workAgainPortion").hide();
                $("#a_ReviewPortion").hide();
                $("#c_ReviewPortion").hide();
            } else if (this.value == '2') { //commissioner
                $('form').append('<input type="hidden" name="form_type" value="' + constant_cc + '">');

                $("#getArtistType").hide();
                $("#leftPortion").show();
                $("#usersPortion").show();
                $("#user_id option[value='']").remove();
                $("#user_id option").eq(0).before($("<option selected disabled></option>").val("").text("--Select Drawn By--"));
                $("#subjectsPortion").show();
                $("#mediumsPortion").show();
                $("#titlePortion").show();
                $("#descriptionPortion").show();
                $("#keywordsPortion").show();
                $("#workAgainPortion").show();
                $("#c_ReviewPortion").show();
            }
        });
        $('input[type=radio][name=artist_type]').change(function() {
            if (this.value == '1') { //personal
                $('form').append('<input type="hidden" name="form_type" value="' + constant_ap + '">');

                $("#leftPortion").show();
                $("#subjectsPortion").show();
                $("#mediumsPortion").show();
                $("#titlePortion").show();
                $("#descriptionPortion").show();
                $("#keywordsPortion").show();
                $("#a_ReviewPortion").hide();
                $("#c_ReviewPortion").hide();
            } else if (this.value == '2') { //commissioned
                $('form').append('<input type="hidden" name="form_type" value="' + constant_ac + '">');

                $("#leftPortion").show();
                $("#usersPortion").show();
                $("#user_id option[value='']").remove();
                $("#user_id option").eq(0).before($("<option selected disabled></option>").val("").text("--Select Commissioned By--"));
                $("#subjectsPortion").show();
                $("#mediumsPortion").show();
                $("#titlePortion").show();
                $("#descriptionPortion").show();
                $("#keywordsPortion").show();
                $("#workAgainPortion").show();
                $("#a_ReviewPortion").show();
            }
        });


        $('#user_id').on('change', function() {
            var selectedText = $(this).find("option:selected").text();
            $('#setUser').html(selectedText);
        });
    });
</script>
@endsection