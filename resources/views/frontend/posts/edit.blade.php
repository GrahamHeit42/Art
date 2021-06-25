@extends('frontend.layouts.app')
@push('styles')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    .text-black {
        color: black !important;
    }

    .drop-zone {
		max-width: 200px;
		height: 200px;
		/* padding: 2px; */
		margin: 7px;
		display: flex;
		align-items: center;
		justify-content: center;
		text-align: center;
		/* font-family: "Quicksand", sans-serif; */
		font-weight: 500;
		font-size: 20px;
		cursor: pointer;
		color: #cccccc;
		border: 4px dashed lightgray;
		border-radius: 10px;
	}

	.drop-zone--over {
		border-style: solid;
	}

	.drop-zone__input {
		display: none;
	}

	.drop-zone__thumb {
		width: 100%;
		height: 100%;
		border-radius: 10px;
		overflow: hidden;
		background-color: #cccccc;
		background-size: cover;
		position: relative;
	}

	.drop-zone__thumb::after {
		content: attr(data-label);
		position: absolute;
		bottom: 0;
		left: 0;
		width: 100%;
		padding: 5px 0;
		color: #ffffff;
		background: rgba(0, 0, 0, 0.75);
		font-size: 14px;
		text-align: center;
	}

    span.removeImage {
        position: absolute;
        top: 5%;
        right: 5%;
        color: white;
        z-index: 9;
        font-weight: bold;
    }
</style>
@endpush
@section('content')
<div id="container">
    <div class="container-fluid artistwrapper">
        <form id="edit-post-form" class="upload-post" action="{{ url('posts/store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    {{-- <div class="row" id="post-images-preview"></div>
                    <div class="upload-info">
                        <div class="upload-btn-wrapper row">
                            <input type="hidden" value="{{$post->images}}" id="postImagesId" />
                            <input id="post-images" type="file" accept="image/*" multiple />
                        </div>
                    </div> --}}
                    <div class="row" id="image-row-1">
                        @foreach ($post->images as $key => $image)
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 images-row" data-id="{{ $image->id }}">
                                <div class="drop-zone" style="position: relative;">
                                    <span class="removeImage" onclick="removeImage({{ $image->id }})">X</span>
                                    <img src="{{ asset($image->image_path) }}" style="height: 100%; width: 100%;"/>
                                </div>
                            </div>
                        @endforeach
                        @php $remainImage = $post->images->count(); @endphp
                        @for ($i = 0; $i < (9 - $post->images->count()); $i++)
                        @php $remainImage = $remainImage + 1 @endphp
                            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 images-row" style="display: none;">
                                <div class="drop-zone" style="position: relative;">
                                    <span class="drop-zone__prompt">
                                        <button class="btn btn-info" type="button">Upload</button>
                                    </span>
                                    <span style="display: none;" class="removeImage" onclick="removeImage(this)">X</span>
                                    <input type="file" name="images[{{ $remainImage }}]" id="post-images-{{ $remainImage }}" class="drop-zone__input">
                                </div>
                            </div>
                        @endfor
                        @if($post->images->count() < 9)
                            <div id="add-more-div" class="text-center add-more-div">
                                <button type="button" id="add-more" class="btn btn-success" onclick="$('.images-row').show();$(this).parent().hide();">
                                    Add More
                                </button>
                            </div>
                        @endif
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
                                    @if($type == config('constants.Commissioner') || $type ==
                                    config('constants.Commisioned'))
                                    @php
                                        $selectedUserId = "";
                                        if($type == config('constants.Commisioned')) {
                                            $selectedUserId = $post->commisioned_by;
                                        }
                                        else if($type == config('constants.Commissioner')) {
                                            $selectedUserId = $post->drawn_by;
                                        }
                                    @endphp

                                    <select class="username-matter-dropdown" name="username" id="username"
                                        title="Username">
                                        @foreach($usernames as $username)
                                            <option value="{{ $username->id }}" {{ $selectedUserId == $username->id ? 'selected' : ''}}>{{ $username->username }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>

                            <div class="post-dropdown mt-2">
                                <div class="subject-matter">
                                    <select class="subject-matter-dropdown" name="subject_id" id="subject_id"
                                        title="Subject">
                                        <option value="">Subject</option>
                                        @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{$post->subject_id == $subject->id ? 'selected' : NULL }}>
                                            {{ $subject->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="medium-dropdown">
                                    <select class="medium-matter-dropdown" name="medium_id" id="medium_id"
                                        title="Medium">
                                        <option value="">Medium</option>
                                        @foreach($mediums as $medium)
                                        <option value="{{ $medium->id }}"
                                            {{ $post->medium_id == $medium->id ? 'selected' : NULL }}>
                                            {{ $medium->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-group mt-2">
                                <input type="text" class="form-control" placeholder="Title" name="title" id="title"
                                    title="Title" value="{{ $post->title }}" />
                            </div>
                            <div class="input-group mt-2">
                                <textarea class="form-control" cols="30" rows="10" name="description" id="description"
                                    title="Description" placeholder="Description">{{ $post->description }}</textarea>
                            </div>
                            <div class="input-group hashtag mt-3">
                                <select class="keywords-multiple" name="keywords[]" multiple="multiple" title="Keywords"
                                    id="keywords">
                                    @if (!empty($post->keywords))

                                    @endif
                                </select>
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
                                            @for($rating = 0; $rating <= 5; $rating++)
                                                @if($rating> 0)
                                                <label aria-label="{{ $rating }} star" class="rating__label"
                                                    for="transaction-{{ $rating }}">
                                                    <i class="rating__icon rating__icon--star fa fa-star"></i>
                                                </label>
                                                @endif
                                                <input
                                                    class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                                    name="transaction" id="transaction-{{ $rating }}"
                                                    value="{{ $rating }}" type="radio"
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->transaction ? 'checked' : NULL) }}>
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
                                                    name="price" id="price-{{ $rating }}" value="{{ $rating }}"
                                                    type="radio"
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->price ? 'checked' : NULL) }}>
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
                                                    name="speed" id="speed-{{ $rating }}" value="{{ $rating }}"
                                                    type="radio"
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->speed ? 'checked' : NULL) }}>
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
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->communication ? 'checked' : NULL) }}>
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
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->concept ? 'checked' : NULL) }}>
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
                                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->quality ? 'checked' : NULL) }}>
                                                @endfor
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="rateing">
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
                                <input class="rating__input {{ $rating === 0 ? 'rating__input--none' : '' }}"
                                    name="professionalism" id="professionalism-{{ $rating }}" value="{{ $rating }}"
                                    type="radio"
                                    {{ $rating === 0 ? 'disabled checked' : ($rating == $post->professionalism ? 'checked' : NULL) }}>
                                @endfor
                            </div>
                        </div>
                    </div> --}}
                    @endif

                </div>
                @if($type !== config('constants.Artist'))
                <div class="feedback">
                    <h5>Would you Work with <span id="setUser"></span> again?</h5>
                    <div class="feedback-op">
                        <a id="selectNo"
                            class="btn btnyellow {{($post->want_work_again == 0) ? 'text-black' : ''}}">No</a>
                        <a id="selectYes"
                            class="btn btngreen {{($post->want_work_again == 1) ? 'text-black' : ''}}">Yes</a>
                        <input type="radio" name="work_again" value="0" style="display: none;" />
                        <input type="radio" name="work_again" value="1" style="display: none;" />
                    </div>
                </div>
                <div class="note">
                    {{-- <h5>( not display on post )</h5> --}}
                </div>
                @endif

            </div>
            <!-- </form> -->
    </div>
</div>
<div class="col-lg-2">
    <div class="thumbnailbox">
        <input type="text" name="crop_cover_image" id="upload-thumbnail-image-crop" style="display: none;">
        <div class="upload-thumb">
            <h2 class="thumbnailtext">Thumbnail</h2>
            <input type="file" name="cover_image" id="upload-thumbnail-image" accept="image/*">
            <img src="{{ asset($post->cover_image ?? 'assets/images/upload-image.png') }}" alt="Upload image"
                width="229" height="228" id="thumbnail-image-preview" />
            <div class="thubnailbtn">
                <a href="#" class="btngreen">Crop</a>
                <a href="#" class="btngreen">Upload</a>
            </div>
        </div>
        <!-- start crop image modal-->
        <div id="uploadimageModal" class="modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                        <h4 class="modal-title">Upload & Crop Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="image_demo" style=""></div>
                            </div>
                            <div class="col-md-12 text-center" style="padding-top:30px;">
                                <button type="button" class="btn btn-success crop_image">Crop & Upload
                                    Image</button>
                                <button type="button" class="btn btn-secondary btn-modal-hide"
                                    style="margin-left: 2%">Close</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end crop image modal-->
        <div class="maturitybox">
            <h2>Maturity Rating</h2>
            <div class="maturityrating">
                <input class="maturityrating_input" type="radio" name="maturity_rating" value="1" id="general"
                    {{($post->maturity_rating == 1) ? 'checked' : ''}}>
                <label for="general">General</label>
            </div>
            <div class="maturityrating">
                <input class="maturityrating_input" type="radio" name="maturity_rating" value="2" id="mature"
                    {{($post->maturity_rating == 2) ? 'checked' : ''}}>
                <label for="mature">Mature</label>
            </div>
            <div class="maturityrating">
                <input class="maturityrating_input" type="radio" name="maturity_rating" value="3" id="adult"
                    {{($post->maturity_rating == 3) ? 'checked' : ''}}>
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
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.0/croppie.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.4.0/croppie.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    var uploadImagesCount = 0;
	var uploadImages = [];
	var allImages = [];
    var sorting_images = [];

    $(document).ready(function() {

        //check if rating given then edit only subject, medium, keywords
        @if($post->price != 0 || $post->speed != 0 || $post->quality != 0 || $post->communication != 0 || $post->transaction != 0 || $post->concept != 0 || $post->understanding != 0)
            $('#post-images').attr('disabled','disabled');
            // $('.spanclose').hide();
            $("#add-more").css({"background-color":"gray","border-color":"gray"});
            $('#username').attr('disabled','disabled');
            $('#title').attr('disabled','disabled');
            $('#description').attr('disabled','disabled');
            $('#selectYes').css('pointer-events','none');
            $('#selectNo').css('pointer-events','none');
            $('#upload-thumbnail-image').attr('disabled','disabled');
            $('.maturityrating_input').attr('disabled','disabled');
            $('.rating__input').attr('readonly',true);
        @endif

        //crop image
		$image_crop = $('#image_demo').croppie({
			enableExif: true,
			viewport: {
				width: 200,
				height: 200,
				type: 'square' //circle
			},
			boundary: {
				width: 300,
				height: 300
			}
		});

        $('#upload-thumbnail-image').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function(){
                    // console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $("#upload-thumbnail-image-crop").val(response);
                $('#uploadimageModal').modal('hide');
                $('#thumbnail-image-preview').attr('src',response);
            })
        });
        $(".btn-modal-hide").on("click",function(){
            $('#uploadimageModal').modal('hide');
        });
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
            $('input:radio[name=work_again]:nth(1)').attr('checked', false);
            if ($('#selectYes').hasClass('text-black')) {
                $('#selectYes').removeClass('text-black');
            }
            $('#selectNo').addClass('text-black');
        });
        $("#selectYes").click(function() {
            $('input:radio[name=work_again]:nth(1)').attr('checked', true);
            $('input:radio[name=work_again]:nth(0)').attr('checked', false);
            if ($('#selectNo').hasClass('text-black')) {
                $('#selectNo').removeClass('text-black');
            }
            $('#selectYes').addClass('text-black');
        });

        //use select2
        // $('.username-matter-dropdown').select2({
        //     placeholder: "Select User",
        //     tags: true
        // });
        $('.username-matter-dropdown').select2({
			placeholder: "Select {{ $type === config('constants.Commisioned') ? 'Commissioned By' : 'Drawn By' }}",
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
        /*$('.keywords-multiple').select2({
            placeholder: "Keywords",
            tags: true,
            createTag: function(params) {
                // empty string is not allow
                var term = $.trim(params.term).replace(/\s/g,'');
                if (term === "") {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                };
            }
        });*/
        $('.keywords-multiple').select2({
			placeholder: "Keywords",
			tags: true,
			tokenSeparators: [',', ' ']
			// createTag: function(params) {
			//     // empty string is not allow so removing empty string
			//     var term = $.trim(params.term).replace(/\s/g,'');
			//     if (term === "") {
			//         return null;
			//     }
			//     return {
			//         id: term,
			//         text: term,
			//         newTag: true // add additional parameters
			//     };
			// }
		});

        $( "#image-row-1" ).sortable({
                placeholder: "ui-state-highlight",
                helper: 'clone',
                update: function( event, ui ) {
                    sorting_images = [];
                    $(this).children().each(function(index) {
                        if($(this).data('id') != null){
                            var imageId = $(this).data('id');
                            sorting_images.push({
                                image_id: imageId,
                                order_id: parseInt(index) + 1
                            });
                        }
                    });
                    updateSortOrdersImages();
                }
            });
            $( "#image-row-1" ).disableSelection();

        // $(".images-row").sortable({
        //     revert: true,
        //     stop: function(event, ui) {
        //         sortingOrder(this);
        //         if(!ui.item.data('tag') && !ui.item.data('handle')) {
        //             ui.item.data('tag', true);
        //         }
        //     }
        // });
    });

    // sorting order
    // var imageOrderId = [];

    // function sortingOrder(){
    //     $(".images-row").each(function(index){
    //         if($(this).data('id') != null){
    //             var imageId = $(this).data('id');
    //             imageOrderId.push({
    //                 image_id: imageId,
    //                 order_id: parseInt(index) + 1
    //             });
    //         }
    //     });
    //     // imageOrderId.forEach(function(data){
    //     //     ajaxSorting(data);
    //     // });
    // }

    function updateSortOrdersImages(data){
        // var dataObject = Object.assign({}, data);

        let formData = new FormData();
        // formData.append('image_id', data['image_id']);
        // formData.append('order_id', data['order_id']);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('sorting_images', JSON.stringify(sorting_images));

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $.ajax({
            url: '{{ url("posts/images-order") }}',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response.message);
                if(response.status === true) {
                    toastr.success('Success', response.message, toastrOptions);
                }
                else {
                    toastr.error('Error', response.message, toastrOptions);
                }
            },
            error: function(xhr,response) {
                // console.log(xhr.responseJSON.errors);
                toastr.error('Error', xhr.responseJSON.message, toastrOptions);
            }
        });
    }

    // set username
    // @php
    //     $username = "";
    //     if($type == config('constants.Commisioned')){
    //     $username = $post->commisioned_by;
    // }else if($type == config('constants.Commissioner')){
    //     $username = $post->drawn_by;
    // }
    // @endphp
    // var username_id = {!! json_encode($username) !!};
    // alert(username_id);
    // $('[name=username]').val(username_id);

    //end set username
    //set keywords
    var post_keywords = {!! json_encode(explode(",",$post->keywords)) !!}
    post_keywords.forEach(function(data){
        var newOption = new Option(data, data, true, true);
        $('#keywords').append(newOption).trigger('change');
    });

    //end set keywords

    //display images from database
    // var postImages = [];
    // var postImagesArr = {!! json_encode($post->images->toArray()) !!};
    // postImagesArr.forEach(function(data){
    //     postImages.push(data.image_path);
    //     // allImages.push(data);
    // });

    // var uploadImagesCount = postImages.length;

    // var singleUploadBtn = '<a class="btngreen btngreen-upload">UPLOAD</a>';

    // var addMoreBtn = '<div id="add-more-div" class="text-center add-more-div"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>';

    // if(postImagesArr.length == 0){
        // // $(".upload-btn-wrapper").append('<a class="btngreen btngreen-upload">UPLOAD</a> <input id="post-images" type="file" accept="image/*" multiple />');
        // $(".upload-btn-wrapper").append(singleUploadBtn);
    // }else{
        // $(".upload-btn-wrapper").append(addMoreBtn);
        // postImagesArr.forEach(function(data){
            // if(postImages.length == 1){
                // $('<div class="w-30" data-id="'+data.id+'" data-order=""><img class="gridImage" src="{{ asset('/') }}'+data.image_path+'"></div>').insertBefore(".add-more-div");
            // }
            // else{
                // $('<div class="w-30" data-id="'+data.id+'" data-order=""><span class="spanclose" data-imgpath="'+data.image_path+'">&times;</span><img class="gridImage" src="{{ asset('/') }}'+data.image_path+'"></div>').insertBefore(".add-more-div");
            // }
        // });
        // $(".upload-btn-wrapper").append('<div id="add-more-div" class="text-center add-more-div"><button type="button" id="add-more" class="btn btn-success" ><input id="post-images" type="file" accept="image/*" multiple />Add More</button></div>');

    // }
    //end display images from database

    //remove image
    // $(".spanclose").click(function () {
    function removeImage(imageId) {
        // let imgpath = $(this).data('imgpath');
        // let BASE_URL = '{{ url("/") }}';

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#DD3333',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                formData.append('image_id', imageId);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: BASE_URL + '/posts/image/delete',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status === true) {
                            Swal.fire('Deleted!',response.message,'success');
                            // --uploadImagesCount;
                            window.location.reload();
                        }
                        else {
                            Swal.fire('Error',response.message,'error');
                        }
                    }
                });
            }
        });
    }

    // function funRemoveImage(t) {
    //     --uploadImagesCount;

    //     var imgname = $(t).closest('div').find('img').attr('src');

    //     imgname = imgname.replace(ASSET_URL,'');
    //     var imgname_index = allImages.indexOf(imgname);

    //     allImages.forEach(function(data){
    //         if(data.image_path == imgname){
    //             allImages.splice(imgname_index, 1);
    //         }
    //     });

    //     $(t).parent().remove();
    //     if (uploadImagesCount == 1) {
    //         $(".w-30").addClass("w-100").removeClass("w-30");
    //         $(".gridImage").addClass("gridSingleImage").removeClass("gridImage");
    //     }
    //     if (uploadImagesCount == 0) {
    //         $("#add-more-div").remove();
    //         $('.btngreen-upload').show();
    //         $('.upload-btn-wrapper').removeClass('row');
    //         $('.upload-btn-wrapper').css('text-align', 'center');
    //     }

    // }

    // $(function() {
        // Multiple images preview in browser
        // var imagesPreview = function(input, placeToInsertImagePreview) {

        //     if (input.files) {
        //         var filesAmount = input.files.length;

        //         for (i = 0; i < filesAmount; i++) {
        //             var reader = new FileReader();

        //             reader.onload = function(event) {
        //                 $('#thumbnail-image-preview').attr('src', event.target.result);
        //             }

        //             reader.readAsDataURL(input.files[i]);
        //         }
        //     }

        // };

        // $('#upload-thumbnail-image').on('change', function() {
        //     imagesPreview(this, '#upload-thumbnail-image');
        // });

        /* var mainImagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                if (uploadImagesCount == 0 && filesAmount === 1) {
                    uploadImagesCount = 1;
                    uploadImages.push(input.files[0]);
                    allImages.push(input.files[0]);

                    $(".upload-btn-wrapper").append(addMoreBtn);

                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<div class="w-100"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridSingleImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview).insertBefore('#add-more-div');
                    }

                    reader.readAsDataURL(input.files[0]);
                    $('.btngreen-upload').hide();


                } else {
                    $('.upload-btn-wrapper').addClass('row');

                    var cnt = parseInt(uploadImagesCount) + parseInt(input.files.length);
                    if (cnt > 9) {
                        alert('Maximum 9 images upload available');
                        return false;
                    }
                    $(".gridSingleImage").addClass("gridImage").removeClass("gridSingleImage");
                    $(".w-100").addClass("w-30").removeClass("w-100");

                    $('.btngreen-upload').hide();
                    if (!$('div').hasClass('add-more-div')) {
                        $(".upload-btn-wrapper").append(addMoreBtn);
                    }
                    $('.upload-btn-wrapper').css('text-align', 'left');

                    for (i = 0; i < input.files.length; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<div class="w-30"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview).insertBefore('#add-more-div');
                        }

                        reader.readAsDataURL(input.files[i]); // for single image upload code break here
                        uploadImagesCount++;
                        uploadImages.push(input.files[i]);
                        allImages.push(input.files[i]);
                    }

                }
            }
        }; */

        // var mainImagesPreview = function(input, placeToInsertImagePreview) {

        //     if (input.files) {
        //         var filesAmount = input.files.length;

        //         $('.btngreen-upload').hide();
        //         $("#add-more-div").show();
        //         $(".upload-info").parent().removeClass('artistcol');

        //         if (uploadImagesCount == 0 && filesAmount === 1) {
        //             uploadImagesCount = 1;
        //             uploadImages.push(input.files[0]);
        //             allImages.push(input.files[0]);

        //             var reader = new FileReader();

        //             // $('.upload-btn-wrapper').addClass('row');
        //             reader.onload = function(event) {
        //                 var html = '<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 justify-content-center" style="position: relative;">'+
        //                         '<img src="'+event.target.result+'" class="container"/>'+
        //                         '<span class="spanclose" onclick="funRemoveImage(this);">&times;</span>'+
        //                     '</div>';
        //                 $("#post-images-preview").html(html);
        //                 $("#post-images-preview").find('.col-xs-12').addClass('first-image');
        //                 /*
        //                 $($.parseHTML('<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="position: relative">
        //                 <span class="spanclose" onclick="funRemoveImage(this);">&times;</span>
        //                 <img class="gridSingleImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
        //                 */
        //             }

        //             reader.readAsDataURL(input.files[0]);
        //         }
        //         else {
        //             var cnt = parseInt(uploadImagesCount) + parseInt(input.files.length);
        //             if (cnt > 9) {
        //                 alert('Maximum 9 images upload available');
        //                 return false;
        //             }
        //             $("#post-images-preview").find('.col-xs-12').removeClass('first-image');

        //             $("#post-images-preview").find('.col-xs-12').removeClass('col-md-12');
        //             $("#post-images-preview").find('.col-xs-12').removeClass('col-lg-12');
        //             $("#post-images-preview").find('.col-xs-12').removeClass('col-sm-12');

        //             $("#post-images-preview").find('.col-xs-12').addClass('col-md-4');
        //             $("#post-images-preview").find('.col-xs-12').addClass('col-lg-4');
        //             $("#post-images-preview").find('.col-xs-12').addClass('col-sm-4');

        //             // $(".gridSingleImage").addClass("gridImage").removeClass("gridSingleImage");
        //             // $(".w-75").addClass("w-30").removeClass("w-75");
        //             // if ($('div').hasClass('add-more-div')) {
        //             //     $("#add-more-div").remove();
        //             // }
        //             // $('.upload-btn-wrapper').css('text-align', 'left');
        //             // $('.upload-info').append('<div id="add-more-div" class="text-center add-more-div"><button type="button" id="add-more" class="btn btn-success" onclick="$(\'#post-images\').click();">Add More</button></div>');

        //             for (i = 0; i < input.files.length; i++) {
        //                 var reader = new FileReader();

        //                 reader.onload = function(event) {
        //                     // $($.parseHTML('<div class="w-30"><span class="spanclose" onclick="funRemoveImage(this);">&times;</span><img class="gridImage" src="' + event.target.result + '"></div>')).appendTo(placeToInsertImagePreview);
        //                     var html = '<div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 justify-content-center" style="position: relative;">'+
        //                         '<img src="'+event.target.result+'" class="container" />'+
        //                         '<span class="spanclose" onclick="funRemoveImage(this);">&times;</span>'+
        //                         '</div>';
        //                     $("#post-images-preview").append(html);
        //                 }

        //                 reader.readAsDataURL(input.files[i]); // for single image upload code break here
        //                 uploadImagesCount++;
        //                 uploadImages.push(input.files[i]);
        //                 allImages.push(input.files[i]);
        //             }

        //         }

        //         if(uploadImagesCount === 9) {
        //             $("#add-more-div").hide();
        //         }
        //     }
        // };

        // $('#post-images').on('change', function() {
        //     // mainImagesPreview(this, '.upload-btn-wrapper');
        //     mainImagesPreview(this, '#post-images-preview');
        // });
    // });


    // IMAGE
	document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
		const dropZoneElement = inputElement.closest(".drop-zone");

		dropZoneElement.addEventListener("click", (e) => {
			inputElement.click();
		});

		inputElement.addEventListener("change", (e) => {
			if (inputElement.files.length) {
				updateThumbnail(dropZoneElement, inputElement.files[0]);
			}
		});

		dropZoneElement.addEventListener("dragover", (e) => {
			e.preventDefault();
			dropZoneElement.classList.add("drop-zone--over");
		});

		["dragleave", "dragend"].forEach((type) => {
			dropZoneElement.addEventListener(type, (e) => {
				dropZoneElement.classList.remove("drop-zone--over");
			});
		});

		dropZoneElement.addEventListener("drop", (e) => {
			e.preventDefault();

			if (e.dataTransfer.files.length) {
				inputElement.files = e.dataTransfer.files;
				updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
			}

			dropZoneElement.classList.remove("drop-zone--over");
		});
	});

	/**
	 * Updates the thumbnail on a drop zone element.
	 *
	 * @param {HTMLElement} dropZoneElement
	 * @param {File} file
	 */
	function updateThumbnail(dropZoneElement, file) {
		let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

		// First time - remove the prompt
		// if (dropZoneElement.querySelector(".drop-zone__prompt")) {
			dropZoneElement.querySelector(".drop-zone__prompt").style.display = 'none';
			dropZoneElement.querySelector(".removeImage").style.display = '';
            console.log(dropZoneElement);
		// }

		// First time - there is no thumbnail element, so lets create it
		if (!thumbnailElement) {
			thumbnailElement = document.createElement("div");
			thumbnailElement.classList.add("drop-zone__thumb");
			dropZoneElement.appendChild(thumbnailElement);
		}

		thumbnailElement.dataset.label = file.name;

		// Show thumbnail for image files
		if (file.type.startsWith("image/")) {
			const reader = new FileReader();

			reader.readAsDataURL(file);
			reader.onload = () => {
				thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                // console.log(thumbnailElement);
			};
		} else {
			thumbnailElement.style.backgroundImage = null;
		}
	}


    $("#edit-post-form").on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData($("#edit-post-form")[0]);
        // allImages.forEach(function(image, i) {
		// 	formData.append('images[' + i + ']', image);
		// });

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
            error: function(xhr,response) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    $("#" + key).addClass("is-invalid");
                    toastr.error(value, '', toastrOptions);
                });
            }
        });
    });
</script>
<script>

</script>
@endpush
