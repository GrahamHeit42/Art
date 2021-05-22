@extends('frontend.layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
<link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
<style>
    /* .gridSingleImage { */
    /* width: 100%; */
    /* height: 90%; */
    /* } */

    .gridImage {
        margin: 1.5%;
        width: 100%;
        height: 200px;
    }

    .w-30 {
        width: 30%;
        position: relative;
        margin: 1.5%;
    }

    .spanclose {
        position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100;
        color: red;
        /* border-radius: 10px; */
        /* background-color: darkgrey; */
        font-size: 2rem;
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div id="container">
    <div class="container-fluid artistwrapper">
        <form id="create-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 artistcol">
                    <div class="upload-info">
                        <div class="upload-btn-wrapper row">
                            <a class="btngreen btngreen-upload">Upload</a>
                            <input id="post-images" type="file" name="images[]" accept="image/*" multiple />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="post-description">
                        <!-- <form id="create-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post" enctype="multipart/form-data">
                        @csrf -->
                        <input hidden name="id" value="{{ $post->id ?? NULL }}" id="post_id" class="form-control" title="ID" />
                        <input hidden name="type" value="{{ $type }}" id="type" class="form-control" title="Type" />
                        <div class="post-details">
                            <div class="username-dropdown">
                                <div class="username-matter">
                                    {{--<input title="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                                    type="text"
                                    class="form-control"
                                    placeholder="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                                    name="owner_name" />--}}
                                    @if($type == config('constants.Commissioner') || $type == config('constants.Commisioned'))
                                    <select class="username-matter-dropdown" name="username" id="username" title="Username">
                                        @foreach($usernames as $username)
                                        <option value="{{ $username->id }}">{{ $username->username }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="input-group owner-name">
                                <input type="text" class="form-control" placeholder="Commissioned by :">
                                <select class="username-matter-dropdown" name="username" id="username" title="Username">
                                    @foreach($usernames as $username)
                                    <option value="{{ $username->id }}">{{ $username->username }}</option>
                            @endforeach
                            </select>
                        </div> --}}
                        <div class="post-dropdown mt-2">
                            <div class="subject-matter">
                                <select class="subject-matter-dropdown" name="subject_id" id="subject_id" title="Subject">
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : NULL }}>
                                        {{ $subject->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="medium-dropdown">
                                <select class="medium-matter-dropdown" name="medium_id" id="medium_id" title="Medium">
                                    @foreach($mediums as $medium)
                                    <option value="{{ $medium->id }}" {{ old('medium_id') == $subject->id ? 'selected' : NULL }}>
                                        {{ $medium->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title" title="Title" value="{{ old('title') }}" />
                        </div>
                        <div class="input-group mt-2">
                            <textarea class="form-control" cols="30" rows="10" name="description" id="description" title="Description" placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                        <div class="input-group hashtag mt-3">
                            <select class="keywords-multiple" name="keywords[]" multiple="multiple" title="Keywords" id="keywords"></select>
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
                                <h5>Transaction
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Transaction"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="transaction" id="transaction-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="transaction-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="transaction" id="transaction-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="transaction-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="transaction" id="transaction-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="transaction-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="transaction" id="transaction-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="transaction-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="transaction" id="transaction-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="transaction-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="transaction" id="transaction-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                            <div class="rateing">
                                <h5>Speed
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Speed"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="speed" id="speed-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="speed-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="speed-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="speed-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="speed-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="speed-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                            <div class="rateing">
                                <h5>Communication
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Communication"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="communication" id="communication-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="communication-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="communication-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="communication-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="communication-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="communication-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                            <div class="rateing">
                                <h5>Prepertion / Concept
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Prepertion / Concept"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="concept" id="concept-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="concept-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="concept-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="concept-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="concept-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="concept-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($type !== config('constants.Artist'))
                        <div class="feedback">
                            <h5>Would you Work with <span id="setUser"></span> again?</h5>
                            <div class="feedback-op">
                                <a id="selectNo" class="btn btnyellow">No</a>
                                <a id="selectYes" class="btn btngreen">Yes</a>
                                <input type="radio" name="work_again" value="0" style="display: none;" />
                                <input type="radio" name="work_again" value="1" style="display: none;" />
                            </div>
                        </div>
                        <div class="note">
                            <h5>( not display on post )</h5>
                        </div>
                        @endif

                    </div>
                    <!-- </form> -->
                </div>
            </div>
            <div class="col-lg-2">
                <div class="thumbnailbox">
                    <div class="upload-thumb">
                        <h2 class="thumbnailtext">Thumbnail</h2>
                        <input type="file" name="cover_image" id="upload-thumbnail-image">
                        <img src="{{ asset('assets/images/upload-image.png') }}" alt="Upload image" width="229" height="228" id="thumbnail-image-preview" />
                        <div class="thubnailbtn">
                            <a href="#" class="btngreen">Crop</a>
                            <a href="#" class="btngreen">Upload</a>
                        </div>
                    </div>
                    <div class="maturitybox">
                        <h2>Maturity Rating</h2>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="1" id="general">
                            <label for="general">General</label>
                        </div>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="2" id="mature">
                            <label for="mature">Mature</label>
                        </div>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="3" id="adult">
                            <label for="adult">Adult</label>
                        </div>
                    </div>
                    <div class="post-submit">
                        <button type="submit" class="btn btngreen">submit</button>
                    </div>
                </div>
            </div>
    </div>
    </form>

</div>
</div>

{{-- <div class="post-upload">
    <div class="container">
        <form id="create-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post"
enctype="multipart/form-data">
@csrf
<input hidden name="id" value="{{ $post->id ?? NULL }}" id="post_id" class="form-control" title="ID" />
<input hidden name="type" value="{{ $type }}" id="type" class="form-control" title="Type" />
<div class="row">
    <div class="col-lg-6">
        <div class="upload-info">
            {{--<input id="cover-image" type="file" name="cover_image" accept="image/*"/>- -}}
            <input id="post-images" type="file" name="images[]" accept="image/*" multiple />
            {{--<input id="file-upload" type="file" name="fileUpload" accept="image/*"/>

                            <label for="file-upload" id="file-drag">
                                <img id="file-image" src="#" alt="Preview" class="hidden">
                                <div id="start">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <div>Select a file or drag here</div>
                                    <div id="notimage" class="hidden">Please select an image</div>
                                    <span id="file-upload-btn" class="btn gallery-btn-green">Select a file</span>
                                </div>
                                <div id="response" class="hidden">
                                    <div id="messages"></div>
                                    <progress class="progress" id="file-progress" value="0">
                                        <span>0</span>%
                                    </progress>
                                </div>
                            </label> - -}}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="post-description">
            <form action="">
                <div class="post-details">
                    <div class="username-dropdown">
                        <div class="username-matter">
                            {{--<input title="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                            type="text"
                            class="form-control"
                            placeholder="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                            name="owner_name" />- -}}
                            <select class="username-matter-dropdown" name="username" id="username" title="Username">
                                @foreach($usernames as $username)
                                <option value="{{ $username->id }}">{{ $username->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="post-dropdown">
                        <div class="subject-matter">
                            <select class="subject-matter-dropdown" name="subject_id" id="subject_id" title="Subject">
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : NULL }}>
                                    {{ $subject->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="medium-dropdown">
                            <select class="medium-matter-dropdown" name="medium_id" id="medium_id" title="Medium">
                                @foreach($mediums as $medium)
                                <option value="{{ $medium->id }}" {{ old('medium_id') == $subject->id ? 'selected' : NULL }}>
                                    {{ $medium->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Title" name="title" id="title" title="Title" value="{{ old('title') }}" />
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" cols="30" rows="10" name="description" id="description" title="Description" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                    <div class="input-group hashtag">
                        <select class="keywords-multiple" name="keywords[]" multiple="multiple" title="Keywords" id="keywords">
                        </select>
                    </div>
                    <div class="review">
                        <h3>Review: &nbsp;</h3>
                        <p>(Optional)</p>
                    </div>
                    <div class="artist-rating">
                        <div class="rating-title">
                            <span>Very Bad</span>
                            <span>Very Good</span>
                        </div>
                        @if($type === 'artist')
                        <div class="rating">
                            <h5>Transaction
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Transaction"></i>
                            </h5>
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="transaction-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="transaction" id="transaction-{{ $rating }}" value="transaction-{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('transaction') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="rating">
                            <h5>Price
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Price"></i>
                            </h5>
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="price-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="price" id="price-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('price') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="rating">
                            <h5>Speed
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Speed"></i>
                            </h5>
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="speed-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="speed" id="speed-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('speed') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <div class="rating">
                            <h5>Communication
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Communication"></i>
                            </h5>
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="communication-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="communication" id="communication-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('communication') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @if($type === 'artist')
                        <div class="rating">
                            <h5>Prepertion / Concept
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Prepertion / Concept"></i>
                            </h5>

                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="concept-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="concept" id="concept-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('concept') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="rating">
                            <h5>Quality
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Quality"></i>
                            </h5>
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="quality-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="quality" id="quality-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('quality') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <div class="rating">
                            <h5>Professionalism
                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Professionalism"></i>
                            </h5>

                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                        <label aria-label="{{ $rating }} star" class="rating__label" for="professionalism-{{ $rating }}">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        @endif
                                        <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="professionalism" id="professionalism-{{ $rating }}" value="{{ $rating }}" type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('professionalism') ? 'checked' : NULL) }}>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="feedback">
                        <h5>Would you Work with ____ again?</h5>
                        <div class="feedback-op">
                            <a class="btn gallery-btn-yellow">No</a>
                            <a class="btn gallery-btn-green">Yes</a>
                        </div>
                    </div>
                    <div class="note">
                        <h5>(Not display on post)</h5>
                    </div>
                    <div class="post-submit">
                        <button type="submit" class="btn gallery-btn-green">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</form>
</div>
</div> --}}
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //set username
        setUserSpan();
        $('#username').on('change', function() {
            setUserSpan();
        });

        function setUserSpan() {
            var setuser = $('#username').find('option:selected').text();
            $('#setUser').html(setuser);
        }

        //set work with yes no
        $("#selectNo").click(function() {
            $('input:radio[name=work_again]:nth(0)').attr('checked', true);
        });
        $("#selectYes").click(function() {
            $('input:radio[name=work_again]:nth(1)').attr('checked', true);
        });

        //use select2
        $('.username-matter-dropdown').select2({
            placeholder: "Select User",
            tags: true
        });
        $('.subject-matter-dropdown').select2({
            placeholder: "Select Subject"
        });
        $('.medium-matter-dropdown').select2({
            placeholder: "Select Medium"
        });
        $('.keywords-multiple').select2({
            placeholder: "Keywords",
            tags: true
        });
    });
    //remove image
    function funRemoveImage(t) {
        $(t).parent().remove();
    }
</script>
<script type="text/javascript">
    var uploadImagesCount = 0;
    var uploadImages = [];
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $('#thumbnail-image-preview').attr('src', event.target.result);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#upload-thumbnail-image').on('change', function() {
            imagesPreview(this, '#upload-thumbnail-image');
        });

        var mainImagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                if (uploadImagesCount == 0 && filesAmount === 1) {
                    uploadImagesCount = 1;
                    uploadImages.push(input.files[0]);

                    var reader = new FileReader();

                    reader.onload = function(event) {
                        // $($.parseHTML('<img class="gridSingleImage">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        $($.parseHTML('<div class="w-30"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridSingleImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[0]);
                    $('.btngreen-upload').hide();
                    $('.upload-info').append('<div id="add-more-div" class="text-center"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>');

                } else {
                    var cnt = parseInt(uploadImagesCount) + parseInt(input.files.length);
                    if (cnt > 9) {
                        alert('Maximum 9 images upload available');
                        return false;
                    }
                    $(".gridSingleImage").addClass("gridImage").removeClass("gridSingleImage");
                    $("#add-more-div").remove();
                    for (i = 0; i < input.files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<div class="w-30"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
                            // $($.parseHTML('<img class="gridImage">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                        uploadImagesCount++;
                        uploadImages.push(input.files[i]);
                    }
                    $('.btngreen-upload').hide();
                    $('.upload-btn-wrapper').css('text-align', 'left');
                    $('.upload-info').append('<div id="add-more-div" class="text-center"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>');
                }
            }
        };
        $('#post-images').on('change', function() {
            mainImagesPreview(this, '.upload-btn-wrapper');
        });
    });
</script>
@endpush