@extends('frontend.layouts.sidebar')
@section('title','New Post')
@section('page-header')
<link href="{{ asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">
<script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
<style type="text/css">
    .dropdown-toggle {
        margin: 5px;
    }

    .dropzone {
        border: 1px solid gray;
        padding: 30%;
        cursor: pointer;
        border-radius: 20px;
    }
</style>
@endsection
@section('content')
<div id="main">
    <div class="post-upload">
        <div class="container">
            <form method="POST" action="{{ url('frontside/posts/save') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="upload-info">
                            <div id="file-upload-form" class="upload-post">
                                <input type="file" name="images[]" id="images" multiple style="display: block;" accept="image/*" />

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="post-description">
                            <!-- <form action=""> -->
                            @if($page == config('constants.AC'))
                            <input type="hidden" value="{{config('constants.AC')}}" name="form_type" />
                            @else
                            <input type="hidden" value="{{config('constants.AP')}}" name="form_type" />
                            @endif
                            <input type="hidden" value="1" name="user_type" />
                            @if($page == config('constants.AC'))
                            <input type="hidden" value="2" name="artist_type" />
                            @else
                            <input type="hidden" value="1" name="artist_type" />
                            @endif
                            <div class="post-details">
                                @if($page == config('constants.AC'))
                                <div class="input-group owner-name">
                                    @if(isset($users) && !empty($users))
                                    <select name="user_id" id="user_id" class="form-control ">
                                        <option value="" disabled selected>Commisioned By</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <small class="form-text text-danger">{!! $errors->first('user_id') !!}</small>
                                </div>
                                @endif
                                <div class="post-dropdown">
                                    <div class="subject-matter">
                                        <select class="subject-matter-dropdown" name="subject_id" id="subject_id">
                                            <option value="" disabled selected>Subject</option>
                                            @if(isset($subjects))
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="medium-dropdown">
                                        <select class="medium-matter-dropdown" name="medium_id" id="medium_id">
                                            <option value="" disabled selected>Medium</option>
                                            @if(isset($mediums))
                                            @foreach($mediums as $medium)
                                            <option value="{{$medium->id}}">{{$medium->type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Title :" name="title" id="title">
                                </div>
                                <div class="input-group">
                                    <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <div class="input-group hashtag">
                                    <input type="text" name="keywords" id="keywords" class="form-control" placeholder="I Keywords - Separated by spaces">
                                </div>
                                @if($page == config('constants.AC'))
                                <div class="review">
                                    <h3>Review : &nbsp;</h3>
                                    <p>( Optional )</p>
                                </div>
                                <div class="artist-rateing">
                                    <div class="rateing-title">
                                        <span>Very Bad</span>
                                        <span>Very Good</span>
                                    </div>
                                    <div class="rateing">
                                        <h5>Transaction
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Transaction"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Concept
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="concept"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Understanding
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Understanding"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Communication
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Communication"></i>
                                        </h5>

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
                                    </div>
                                </div>
                                <div class="feedback">
                                    <h5>Would you Work with <span id="setUser"></span> again?</h5>
                                    <div class="feedback-op">
                                        <!-- <a class="btn gallery-btn-yellow">No</a> -->
                                        <!-- <a class="btn gallery-btn-green">Yes</a> -->
                                        <input type="radio" name="work_again" id="work_again" value="1" class="btn gallery-btn-green" />Yes
                                        <input type="radio" name="work_again" id="work_again" value="0" class="btn gallery-btn-yellow" class="btn gallery-btn-yellow" />No
                                    </div>
                                </div>
                                @endif
                                <div class="post-submit">
                                    <button type="submit" class="btn gallery-btn-green">Submit</button>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('page-footer')
<script type="text/javascript">
    var uploadedDocumentMap = {};

    /*new Dropzone("div#file-upload-form", {
        url: "{{ url('dropzone/store') }}",
    });*/

    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {
        var myDropzone = new Dropzone("div#file-upload-form", {
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#user_id').on('change', function() {
            var selectedText = $(this).find("option:selected").text();
            $('#setUser').html(selectedText);
        });
    });
</script>
@endsection