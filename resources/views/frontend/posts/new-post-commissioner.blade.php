@extends('frontend.layouts.sidebar')
@section('title','New Post')
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
                            <input type="hidden" value="{{config('constants.CC')}}" name="form_type" />
                            <input type="hidden" value="2" name="user_type" />

                            <div class="post-details">
                                <div class="input-group owner-name">
                                    @if(isset($users) && !empty($users))
                                    <select name="user_id" id="user_id" class="form-control ">
                                        <option value="" disabled selected>Drawn By</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <small class="form-text text-danger">{!! $errors->first('user_id') !!}</small>
                                </div>
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
                                        <h5>Price
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Price"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Speed
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Speed"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Quality
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Quality"></i>
                                        </h5>
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
                                    </div>
                                    <div class="rateing">
                                        <h5>Communication
                                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Communication"></i>
                                        </h5>

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
                                    </div>
                                </div>
                                <div class="feedback">
                                    <h5>Would you Work with <span id="setUser"></span> again?</h5>
                                    <div class="feedback-op">
                                        <input type="radio" name="work_again" id="work_again" value="1" class="btn gallery-btn-green" />Yes
                                        <input type="radio" name="work_again" id="work_again" value="0" class="btn gallery-btn-yellow" class="btn gallery-btn-yellow" />No
                                    </div>
                                </div>
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
    $(document).ready(function() {
        $('#user_id').on('change', function() {
            var selectedText = $(this).find("option:selected").text();
            $('#setUser').html(selectedText);
        });
    });
</script>
@endsection