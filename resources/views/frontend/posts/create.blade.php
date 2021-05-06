@extends('frontend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="post-upload">
        <div class="container">
            <form id="create-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input hidden name="id" value="{{ $post->id ?? NULL }}" id="post_id" class="form-control" title="ID" />
                <input hidden name="type" value="{{ $type }}" id="type" class="form-control" title="Type" />
                <div class="row">
                    <div class="col-lg-6">
                        <div class="upload-info">
                            {{--<input id="cover-image" type="file" name="cover_image" accept="image/*"/>--}}
                            <input id="post-images" type="file" name="images[]" accept="image/*" multiple/>
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
                            </label>--}}
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
                                                   name="owner_name" />--}}
                                            <select class="username-matter-dropdown" name="username" id="username"
                                                    title="Username">
                                                @foreach($usernames as $username)
                                                    <option value="{{ $username->id }}">{{ $username->username }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="post-dropdown">
                                        <div class="subject-matter">
                                            <select class="subject-matter-dropdown" name="subject_id" id="subject_id"
                                                    title="Subject">
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : NULL }}>{{ $subject->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="medium-dropdown">
                                            <select class="medium-matter-dropdown" name="medium_id" id="medium_id"
                                                    title="Medium">
                                                @foreach($mediums as $medium)
                                                    <option value="{{ $medium->id }}" {{ old('medium_id') == $subject->id ? 'selected' : NULL }}>{{ $medium->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Title" name="title"
                                               id="title" title="Title" value="{{ old('title') }}"/>
                                    </div>
                                    <div class="input-group">
                                    <textarea class="form-control" cols="30" rows="10" name="description"
                                              id="description" title="Description" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="input-group hashtag">
                                        <select class="keywords-multiple" name="keywords[]" multiple="multiple" title="Keywords"
                                                id="keywords">
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
                                                    <i class="fa fa-info-circle" aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Transaction"></i>
                                                </h5>
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        @for($rating = 0; $rating <= 5; $rating++)
                                                            @if($rating > 0)
                                                                <label aria-label="{{ $rating }} star"
                                                                       class="rating__label"
                                                                       for="transaction-{{ $rating }}">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                            @endif
                                                            <input
                                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                                name="transaction" id="transaction-{{ $rating }}"
                                                                value="transaction-{{ $rating }}"
                                                                type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('transaction') ? 'checked' : NULL) }}>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="rating">
                                                <h5>Price
                                                    <i class="fa fa-info-circle" aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Price"></i>
                                                </h5>
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        @for($rating = 0; $rating <= 5; $rating++)
                                                            @if($rating > 0)
                                                                <label aria-label="{{ $rating }} star"
                                                                       class="rating__label" for="price-{{ $rating }}">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                            @endif
                                                            <input
                                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                                name="price" id="price-{{ $rating }}"
                                                                value="{{ $rating }}"
                                                                type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('price') ? 'checked' : NULL) }}>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="rating">
                                            <h5>Speed
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Speed"></i>
                                            </h5>
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    @for($rating = 0; $rating <= 5; $rating++)
                                                        @if($rating > 0)
                                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                                   for="speed-{{ $rating }}">
                                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                            </label>
                                                        @endif
                                                        <input
                                                            class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                            name="speed" id="speed-{{ $rating }}"
                                                            value="{{ $rating }}"
                                                            type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('speed') ? 'checked' : NULL) }}>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating">
                                            <h5>Communication
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Communication"></i>
                                            </h5>
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    @for($rating = 0; $rating <= 5; $rating++)
                                                        @if($rating > 0)
                                                            <label aria-label="{{ $rating }} star" class="rating__label"
                                                                   for="communication-{{ $rating }}">
                                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                            </label>
                                                        @endif
                                                        <input
                                                            class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                            name="communication" id="communication-{{ $rating }}"
                                                            value="{{ $rating }}"
                                                            type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('communication') ? 'checked' : NULL) }}>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @if($type === 'artist')
                                            <div class="rating">
                                                <h5>Prepertion / Concept
                                                    <i class="fa fa-info-circle" aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Prepertion / Concept"></i>
                                                </h5>

                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        @for($rating = 0; $rating <= 5; $rating++)
                                                            @if($rating > 0)
                                                                <label aria-label="{{ $rating }} star"
                                                                       class="rating__label"
                                                                       for="concept-{{ $rating }}">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                            @endif
                                                            <input
                                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                                name="concept" id="concept-{{ $rating }}"
                                                                value="{{ $rating }}"
                                                                type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('concept') ? 'checked' : NULL) }}>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="rating">
                                                <h5>Quality
                                                    <i class="fa fa-info-circle" aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Quality"></i>
                                                </h5>
                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        @for($rating = 0; $rating <= 5; $rating++)
                                                            @if($rating > 0)
                                                                <label aria-label="{{ $rating }} star"
                                                                       class="rating__label"
                                                                       for="quality-{{ $rating }}">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                            @endif
                                                            <input
                                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                                name="quality" id="quality-{{ $rating }}"
                                                                value="{{ $rating }}"
                                                                type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('quality') ? 'checked' : NULL) }}>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rating">
                                                <h5>Professionalism
                                                    <i class="fa fa-info-circle" aria-hidden="true"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Professionalism"></i>
                                                </h5>

                                                <div id="full-stars-example-two">
                                                    <div class="rating-group">
                                                        @for($rating = 0; $rating <= 5; $rating++)
                                                            @if($rating > 0)
                                                                <label aria-label="{{ $rating }} star"
                                                                       class="rating__label"
                                                                       for="professionalism-{{ $rating }}">
                                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                                </label>
                                                            @endif
                                                            <input
                                                                class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                                name="professionalism"
                                                                id="professionalism-{{ $rating }}"
                                                                value="{{ $rating }}"
                                                                type="radio" {{ $rating === 0 ? 'disabled checked' : ($rating == old('professionalism') ? 'checked' : NULL) }}>
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
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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
    </script>
@endpush
