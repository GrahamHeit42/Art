@extends('frontend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
@endpush
@section('content')
    <div class="post-upload">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="upload-info">
                        <form id="file-upload-form" class="upload-post">
                            <input id="file-upload" type="file" name="fileUpload" accept="image/*" />

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
                            </label>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="post-description">
                        <form action="">
                            <div class="post-details">
                                <div class="input-group owner-name">
                                    <input title="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}" type="text"
                                           class="form-control"
                                           placeholder="{{ $type === 'artist' ? 'Commissioned By' : 'Drawn By' }}"
                                           name="owner_name" />
                                </div>

                                <div class="post-dropdown">
                                    <div class="subject-matter">
                                        <select class="subject-matter-dropdown" name="subject_id" title="Subject">
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="medium-dropdown">
                                        <select class="medium-matter-dropdown" name="medium_id" title="Medium">
                                            @foreach($mediums as $medium)
                                                <option value="{{ $medium->id }}">{{ $medium->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Title" name="title"
                                           title="Title">
                                </div>
                                <div class="input-group">
                                    <textarea class="form-control" cols="30" rows="10" name="description"
                                              id="description" title="Description" placeholder="Description"></textarea>
                                </div>
                                <div class="input-group hashtag">
                                    <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                        <option value="AL">Alabama</option>
                                        ...
                                        <option value="WY">Wyoming</option>
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
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Transaction"></i>
                                            </h5>
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none"
                                                           name="rating1" id="rating1-none" value="0" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating1-1">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-1" value="1"
                                                           type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating1-2">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-2" value="2"
                                                           type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating1-3">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-3" value="3"
                                                           type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating1-4">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-4" value="4"
                                                           type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating1-5">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-5" value="5"
                                                           type="radio">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rating">
                                            <h5>Price
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Price"></i>
                                            </h5>
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none"
                                                           name="rating1" id="rating1-none" value="0" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating1-1">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-1" value="1"
                                                           type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating1-2">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-2" value="2"
                                                           type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating1-3">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-3" value="3"
                                                           type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating1-4">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-4" value="4"
                                                           type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating1-5">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating1" id="rating1-5" value="5"
                                                           type="radio">
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
                                                <input disabled checked class="rating__input rating__input--none"
                                                       name="rating2" id="rating2-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating2-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating2" id="rating2-1" value="1"
                                                       type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating2-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating2" id="rating2-2" value="2"
                                                       type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating2-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating2" id="rating2-3" value="3"
                                                       type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating2-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating2" id="rating2-4" value="4"
                                                       type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating2-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating2" id="rating2-5" value="5"
                                                       type="radio">
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
                                                <input disabled checked class="rating__input rating__input--none"
                                                       name="rating3" id="rating3-none" value="0" type="radio">
                                                <label aria-label="1 star" class="rating__label" for="rating3-1">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating3" id="rating3-1" value="1"
                                                       type="radio">
                                                <label aria-label="2 stars" class="rating__label" for="rating3-2">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating3" id="rating3-2" value="2"
                                                       type="radio">
                                                <label aria-label="3 stars" class="rating__label" for="rating3-3">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating3" id="rating3-3" value="3"
                                                       type="radio">
                                                <label aria-label="4 stars" class="rating__label" for="rating3-4">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating3" id="rating3-4" value="4"
                                                       type="radio">
                                                <label aria-label="5 stars" class="rating__label" for="rating3-5">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                <input class="rating__input" name="rating3" id="rating3-5" value="5"
                                                       type="radio">
                                            </div>
                                        </div>
                                    </div>
                                    @if($type === 'artist')
                                        <div class="rating">
                                            <h5>Prepertion / Concept
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Prepertion / Concept"></i>
                                            </h5>

                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none"
                                                           name="rating4" id="rating4-none" value="0" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating4-1">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-1" value="1"
                                                           type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating4-2">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-2" value="2"
                                                           type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating4-3">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-3" value="3"
                                                           type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating4-4">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-4" value="4"
                                                           type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating4-5">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-5" value="5"
                                                           type="radio">
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="rating">
                                            <h5>Quality
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Quality"></i>
                                            </h5>
                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none"
                                                           name="rating3" id="rating3-none" value="0" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating3-1">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating3" id="rating3-1" value="1"
                                                           type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating3-2">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating3" id="rating3-2" value="2"
                                                           type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating3-3">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating3" id="rating3-3" value="3"
                                                           type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating3-4">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating3" id="rating3-4" value="4"
                                                           type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating3-5">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating3" id="rating3-5" value="5"
                                                           type="radio">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating">
                                            <h5>Professonalism
                                                <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                                   data-placement="top" title="Professonalism"></i>
                                            </h5>

                                            <div id="full-stars-example-two">
                                                <div class="rating-group">
                                                    <input disabled checked class="rating__input rating__input--none"
                                                           name="rating4" id="rating4-none" value="0" type="radio">
                                                    <label aria-label="1 star" class="rating__label" for="rating4-1">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-1" value="1"
                                                           type="radio">
                                                    <label aria-label="2 stars" class="rating__label" for="rating4-2">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-2" value="2"
                                                           type="radio">
                                                    <label aria-label="3 stars" class="rating__label" for="rating4-3">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-3" value="3"
                                                           type="radio">
                                                    <label aria-label="4 stars" class="rating__label" for="rating4-4">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-4" value="4"
                                                           type="radio">
                                                    <label aria-label="5 stars" class="rating__label" for="rating4-5">
                                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                    </label>
                                                    <input class="rating__input" name="rating4" id="rating4-5" value="5"
                                                           type="radio">
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
                                    <h5>( not display on post )</h5>
                                </div>
                                <div class="post-submit">
                                    <a href="" class="btn gallery-btn-green">submit</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
@endpush
