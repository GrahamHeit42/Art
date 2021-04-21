@extends('admin.layouts.sidebar')
@section('title','New Post')
@section('head-part')
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<style>
    .dropzone {
        border: 1px solid;
        padding: 30px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Post Details</h3>
                </div>

                <div class="dropzone" id="dropzoneFileUpload">
                </div>
                <button type="button" id="uploadPhoto">Upload Photo</button>
                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" id="dropzoneFileUpload" class="dropzone">
                    @csrf
                    <h3>Upload Multiple Image By Click On Box</h3>
                </form>


                <form class="form-horizontal" id="validateForm" method="POST" action="{{ url('posts/save') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{$post->id ?? ''}}" />
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group row col-md-6">
                                <label class="col-sm-3 col-form-label">I am an : </label>
                                <div class="col-sm-9">
                                    <input type="radio" name="user_type" id="user_type" value="1" class="m-7p" />Artist
                                    <input type="radio" name="user_type" id="user_type" value="2" class="m-7p" />Commissioner
                                </div>
                            </div>
                            <div class="form-group row col-md-6" id="getArtistType">
                                <label class="col-sm-4 col-form-label">Upload will be : </label>
                                <div class="col-sm-8">
                                    <input type="radio" name="artist_type" id="artist_type" value="1" class="m-7p" />Personal
                                    <input type="radio" name="artist_type" id="artist_type" value="2" class="m-7p" />Commissioned
                                </div>
                            </div>

                            <div id="getArtistPForm" class="form-group row col-md-12 ">
                                <div class="form-group row col-md-6">

                                </div>
                                <div class="form-group row col-md-6">
                                    <label for="subject_id" class="col-sm-4 col-form-label">Subject</label>
                                    <div class="col-sm-8">
                                        @if(isset($subjects) && !empty($subjects))
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->type}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                        <small class="form-text text-danger">{!! $errors->first('subject_id') !!}</small>
                                    </div>
                                    <!-- </div>
                                <div class="form-group row col-md-6"> -->
                                    <label for="medium_id" class="col-sm-4 col-form-label">Medium</label>
                                    <div class="col-sm-8">
                                        @if(isset($mediums) && !empty($mediums))
                                        <select name="medium_id" id="medium_id" class="form-control">
                                            @foreach($mediums as $mediums)
                                            <option value="{{$mediums->id}}">{{$mediums->type}}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                        <small class="form-text text-danger">{!! $errors->first('medium_id') !!}</small>
                                    </div>
                                </div>
                            </div>
                            <div id="getArtistCForm" class="form-group row col-md-12 ">
                                2222222222</div>
                            <div id="getCommissionerForm" class="form-group row col-md-12 ">
                                3333333333</div>
                        </div><!-- row -->
                    </div> <!-- card-body -->
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
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf"
    };
</script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: "{{url('dropzone/store')}}",
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: false,
            params: {
                _token: "{{csrf_token()}}"
            },

        });

        myDropzone.on("success", function(file, response) {
            // alert(response.name);
            if (response.success == true) {
                alert("Image uploaded successfully");
                $('form').append('<input type="text" name="images[]" value="' + response.name + '">')
            } else {
                alert("Faild to upload image! Try again");
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
        $("#getArtistPForm").hide();
        $("#getArtistCForm").hide();
        $("#getCommissionerForm").hide();

        $('input[type=radio][name=user_type]').change(function() {
            if (this.value == '1') { //artist
                $("#getArtistType").show();
                $("#getArtistPForm").hide();
                $("#getArtistCForm").hide();
                $("#getCommissionerForm").hide();
            } else if (this.value == '2') {
                $("#getCommissionerForm").show();
                $("#getArtistType").hide();
                $("#getArtistPForm").hide();
                $("#getArtistCForm").hide();
            }
        });
        $('input[type=radio][name=artist_type]').change(function() {
            if (this.value == '1') { //personal
                $("#getArtistPForm").show();
                $("#getArtistCForm").hide();
                $("#getCommissionerForm").hide();
            } else if (this.value == '2') {
                $("#getArtistCForm").show();
                $("#getArtistPForm").hide();
                $("#getCommissionerForm").hide();
            }
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