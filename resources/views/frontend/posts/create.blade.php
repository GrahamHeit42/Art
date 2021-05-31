@extends('frontend.layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
<style>
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
        top: -1rem;
        right: 1rem;
        z-index: 100;
        color: red;
        font-size: 3rem;
        cursor: pointer;
    }
</style>
@endpush
@section('content')
<div id="container">
    <div class="container-fluid artistwrapper">
        <form id="create-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6 artistcol">
                    <div class="upload-info">
                        <div class="upload-btn-wrapper">
                            <a class="btngreen btngreen-upload">UPLOAD</a>
                            <input id="post-images" type="file" accept="image/*" multiple />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="post-description">
                        <input hidden name="id" value="{{ $post->id ?? NULL }}" id="post_id" class="form-control"
                            title="ID" />
                        <input hidden name="type" value="{{ $type }}" id="type" class="form-control" title="Type" />
                        <div class="post-details">
                            <div class="username-dropdown">
                                <div class="username-matter">
                                    {{--<input title="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                                    type="text"
                                    class="form-control"
                                    placeholder="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                                    name="owner_name" />--}}
                                    @if($type == config('constants.Commissioner') || $type ==
                                    config('constants.Commisioned'))
                                    <select class="username-matter-dropdown" name="username" id="username"
                                        title="Username">
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
                                <select class="subject-matter-dropdown" name="subject_id" id="subject_id"
                                    title="Subject">
                                    @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : NULL }}>
                                        {{ $subject->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="medium-dropdown">
                                <select class="medium-matter-dropdown" name="medium_id" id="medium_id" title="Medium">
                                    @foreach($mediums as $medium)
                                    <option value="{{ $medium->id }}"
                                        {{ old('medium_id') == $subject->id ? 'selected' : NULL }}>
                                        {{ $medium->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group mt-2">
                            <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                title="Title" value="{{ old('title') }}" />
                        </div>
                        <div class="input-group mt-2">
                            <textarea class="form-control" cols="30" rows="10" name="description" id="description"
                                title="Description" placeholder="Description">{{ old('description') }}</textarea>
                        </div>
                        <div class="input-group hashtag mt-3">
                            <select class="keywords-multiple" name="keywords[]" multiple="multiple" title="Keywords"
                                id="keywords"></select>
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

                            @if($type === 'artist')
                            <div class="rateing">
                                <h5>Transaction
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Transaction"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="transaction-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="transaction" id="transaction-{{ $rating }}" value="{{ $rating }}"
                                                type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('transaction') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="rateing">
                                <h5>Price
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Price"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="price-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="price" id="price-{{ $rating }}" value="{{ $rating }}" type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('price') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="rateing">
                                <h5>Speed
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Speed"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="speed-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="speed" id="speed-{{ $rating }}" value="{{ $rating }}" type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('speed') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="rateing">
                                <h5>Communication
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Communication"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="communication-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="communication" id="communication-{{ $rating }}"
                                                value="{{ $rating }}" type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('communication') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @if($type === 'artist')
                            <div class="rateing">
                                <h5>Prepertion / Concept
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Prepertion / Concept"></i>
                                </h5>

                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="concept-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="concept" id="concept-{{ $rating }}" value="{{ $rating }}"
                                                type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('concept') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="rateing">
                                <h5>Quality
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Quality"></i>
                                </h5>
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="quality-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="quality" id="quality-{{ $rating }}" value="{{ $rating }}"
                                                type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('quality') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="rateing">
                                <h5>Professionalism
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Professionalism"></i>
                                </h5>

                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                for="professionalism-{{ $rating }}">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            @endif
                                            <input
                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                name="professionalism" id="professionalism-{{ $rating }}"
                                                value="{{ $rating }}" type="radio"
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == old('professionalism') ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                            @endif

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
                        <img src="{{ asset('assets/images/upload-image.png') }}" alt="Upload image" width="229"
                            height="228" id="thumbnail-image-preview" />
                        <div class="thubnailbtn">
                            <a href="#" class="btngreen">Crop</a>
                            <a href="#" class="btngreen">Upload</a>
                        </div>
                    </div>
                    <div class="maturitybox">
                        <h2>Maturity Rating</h2>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="1"
                                id="general" checked>
                            <label for="general">General</label>
                        </div>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="2"
                                id="mature">
                            <label for="mature">Mature</label>
                        </div>
                        <div class="maturityrating">
                            <input class="maturityrating_input" type="radio" name="maturity_rating" value="3"
                                id="adult">
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

<div class="row">
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
    <input type="text" class="form-control" placeholder="Title" name="title" id="title" title="Title"
        value="{{ old('title') }}" />
</div>
<div class="input-group">
    <textarea class="form-control" cols="30" rows="10" name="description" id="description" title="Description"
        placeholder="Description">{{ old('description') }}</textarea>
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
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Transaction"></i>
        </h5>
        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="transaction-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="transaction"
                        id="transaction-{{ $rating }}" value="transaction-{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('transaction') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    @else
    <div class="rating">
        <h5>Price
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Price"></i>
        </h5>
        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="price-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="price"
                        id="price-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('price') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    @endif
    <div class="rating">
        <h5>Speed
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Speed"></i>
        </h5>
        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="speed-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="speed"
                        id="speed-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('speed') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    <div class="rating">
        <h5>Communication
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Communication"></i>
        </h5>
        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="communication-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="communication"
                        id="communication-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('communication') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    @if($type === 'artist')
    <div class="rating">
        <h5>Prepertion / Concept
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Prepertion / Concept"></i>
        </h5>

        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="concept-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="concept"
                        id="concept-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('concept') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    @else
    <div class="rating">
        <h5>Quality
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Quality"></i>
        </h5>
        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="quality-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="quality"
                        id="quality-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('quality') ? 'checked' : NULL) }}>
                    @endfor
            </div>
        </div>
    </div>
    <div class="rating">
        <h5>Professionalism
            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                title="Professionalism"></i>
        </h5>

        <div id="full-stars-example-two">
            <div class="rating-group">
                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                    <label aria-label="{{ $rating }} star" class="rating__label" for="professionalism-{{ $rating }}">
                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                    </label>
                    @endif
                    <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}" name="professionalism"
                        id="professionalism-{{ $rating }}" value="{{ $rating }}" type="radio"
                        {{ $rating === 0 ? 'disabled checked' : ($rating == old('professionalism') ? 'checked' : NULL) }}>
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
{{-- <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script> --}}
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
            placeholder: "Select Subject",
            containerCssClass: 'subject-matter-dropdown-container',
            dropdownCssClass: "subject-matter-dropdown-container"
        });
        $('.medium-matter-dropdown').select2({
            placeholder: "Select Medium"
        });
        $('.keywords-multiple').select2({
            placeholder: "Keywords",
            tags: true
        });
    });
</script>
<script type="text/javascript">
    var uploadImagesCount = 0;
    var uploadImages = [];
    var allImages = [];

    //remove image
    function funRemoveImage(t) {
        --uploadImagesCount;
        // var imgname = $(t).closest('.w-30').find('img.gridImage').attr('src');
        var imgname = $(t).closest('div').find('img').attr('src');
        // allImages.pop(imgname); //splice

        var imgname_index = allImages.indexOf(imgname);
            if(imgname_index != -1) {
            allImages.splice(imgname_index, 1);
        }

        $(t).parent().remove();
        if (uploadImagesCount == 1) {
            $(".w-30").addClass("w-100").removeClass("w-30");
            $(".gridImage").addClass("gridSingleImage").removeClass("gridImage");
        }
        if (uploadImagesCount == 0) {
            $("#add-more-div").remove();
            $('.btngreen-upload').show();
            $('.upload-btn-wrapper').removeClass('row');
            $('.upload-btn-wrapper').css('text-align', 'center');
        }
    }

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

                // alert(uploadImagesCount);
                if (uploadImagesCount == 0 && filesAmount === 1) {
                    uploadImagesCount = 1;
                    uploadImages.push(input.files[0]);
                    allImages.push(input.files[0]);

                    var reader = new FileReader();

                    $('.upload-btn-wrapper').addClass('row');
                    reader.onload = function(event) {
                        $($.parseHTML('<div class="w-100"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridSingleImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[0]);
                    $('.btngreen-upload').hide();
                    $('.upload-info').append('<div id="add-more-div" class="text-center add-more-div"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>');

                } else {
                    $('.upload-btn-wrapper').addClass('row');

                    var cnt = parseInt(uploadImagesCount) + parseInt(input.files.length);
                    if (cnt > 9) {
                        alert('Maximum 9 images upload available');
                        return false;
                    }
                    $(".gridSingleImage").addClass("gridImage").removeClass("gridSingleImage");
                    $(".w-100").addClass("w-30").removeClass("w-100");
                    if ($('div').hasClass('add-more-div')) {
                        $("#add-more-div").remove();
                    }

                    $('.btngreen-upload').hide();
                    $('.upload-btn-wrapper').css('text-align', 'left');
                    $('.upload-info').append('<div id="add-more-div" class="text-center add-more-div"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>');

                    for (i = 0; i < input.files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<div class="w-30"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]); // for single image upload code break here
                        uploadImagesCount++;
                        uploadImages.push(input.files[i]);
                        allImages.push(input.files[i]);
                    }

                }
            }
        };
        $('#post-images').on('change', function() {
            mainImagesPreview(this, '.upload-btn-wrapper');
        });
    });
    $("#create-post-form").on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData($("#create-post-form")[0]);
        allImages.forEach(function(image, i) {
            formData.append('images[' + i + ']', image);
        });

        $.ajax({
            url: '{{ url("posts/store") }}',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.status);
                if (response.status === true) {
                    toastr.success(response.message, 'Success', toastrOptions);
                    setTimeout(() => {
                        window.location.href = '{{ url("posts") }}/' + response.id;
                    }, 500);
                } else {
                    toastr.error(response.message, '', toastrOptions);
                }
            },
            error: function(xhr) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $("#" + key).addClass("is-invalid");
                    toastr.error(value, '', toastrOptions);
                });
            }
        });
    });
</script>
<script>
    $(".upload-btn-wrapper").sortable({
    revert: true,
    stop: function(event, ui) {
        if(!ui.item.data('tag') && !ui.item.data('handle')) {
            ui.item.data('tag', true);
        }
    }
});
</script>
@endpush
