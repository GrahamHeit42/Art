@extends('frontend.layouts.app')
@section('title','Post Details')
@push('styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .disablebtn {
        pointer-events: none;
        cursor: default;
        background-color: gray !important;
        border: 1px solid gray !important;
    }
</style>
@endpush

@section('content')
<div id="container">
    <div class="container-fluid postwrapper">
        <div class="row">
            <div class="col-lg-7 postcol">
                <div class="postbox">
                    <div class="postslider owl-carousel">
                        @foreach ($post->images as $image)
                        <div class="item">
                            <img src="{{ asset($image->image_path) }}" alt="Post" width="" height="" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="deslike">
                    <a href="#" onclick="likes();"
                        class="button btngreen like @if($post->post_like_by_user == 1) text-dark @endif"><i
                            class="fas fa-heart"></i> Like</a>
                    <a href="#" onclick="curate();" class="deccreate button btndarkyellow"><i class="fas fa-copy"></i>
                        Curate</a>

                </div>
                @if(isset($post) && Auth::check() && $post->user_id == Auth::user()->id)
                <div class=""><a href="{{url('/posts/edit',$post->id)}}" class="btn btn-info">Edit</a></div>
                @endif
                <div id="postdetails">
                    <ul class="posttab row">
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#description"
                                class="btngreen">Description</a></li>
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#comments"
                                class="btnyellow">Comments</a></li>
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#review"
                                class="btndarkyellow">Review</a></li>
                    </ul>
                    <div id="description">
                        <div class="descriptionbox">
                            <div class="destitle">
                                <h2>{{$post->title}}</h2>
                            </div>
                            <div class="debox">
                                @if(!empty($post->drawnBy))
                                <div class="descuserbox">
                                    <h2>Drawn by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img src="{{ asset($post->drawnBy->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->drawnBy->username ?? "UserName"}}</a>
                                            <a class="btngreen followbtn @if(empty($post->drawnBy) || empty($post->drawnBy->user_id)) disablebtn @endif @if($post->drwan_by_follow == 1) text-dark @endif"
                                                onclick="follow({{$post->drawnBy->id ?? 0}})"><span
                                                    class="setDrawnBy">@if($post->drwan_by_follow
                                                    == 1) Followed @else Follow @endif</span></a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($post->commisionedBy))
                                <div class="descuserbox">
                                    <h2>Commisioned by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img src="{{ asset($post->commisionedBy->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->commisionedBy->username ?? "UserName"}}</a>
                                            <a class="btngreen followbtn @if(empty($post->commisionedBy) || empty($post->commisionedBy->user_id)) disablebtn @endif @if($post->commisioned_by_follow == 1) text-dark @endif"
                                                onclick="follow({{ $post->commisionedBy->id ?? 0}})"><span
                                                    class="setCommisionedBy">@if($post->commisioned_by_follow
                                                    == 1) Followed @else Follow @endif</span></a>
                                        </div>

                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="desinfo">
                                <p>{{$post->description}}</p>
                            </div>

                            <div class="despostdate">
                                <p>Posted: {{ date('M d,Y', strtotime($post->created_at)) }}</p>
                            </div>
                            <div class="likeviewcur">
                                <div class="deslike">
                                    <p><i class="fas fa-heart"></i> <span class="getLikes">{{$post->likes}}</span> Likes
                                    </p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-copy"></i> 000 Curations</p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-eye"></i> {{$post->views_count}} Views</p>
                                </div>
                            </div>
                            <div class="socialdes row">
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" class="btngreen btnfb"><i class="fab fa-facebook-square"></i>
                                        Facebook</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" class="btngreen btntw"><i class="fab fa-twitter-square"></i> Twitter</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" class="btngreen btnpi"><i class="fab fa-pinterest-square"></i>
                                        Pinterest</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" class="btngreen"><i class="fa fa-copy"></i> Share Link</a>
                                </div>
                            </div>
                            <div class="deshastag">
                                <h3>
                                    <a href="#" class="destag"><i class="fas fa-tag"></i>Tags</a>
                                </h3>
                                <?php
                                if(!empty($post->keywords)){
                                    $arr = explode(',', $post->keywords);
                                    foreach ($arr as $value) {
                                        echo '<a href="#" class="btngreen">'.$value.'</a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="comments">
                        <div class="commentsbox">
                            <div class="destitle">
                                <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100" height="100" />
                                <h2>Title</h2>
                            </div>
                            <div class="desowner">
                                <a href="#">By:Username</a>
                                <a href="#">Posted: March 31 2021</a>
                            </div>
                            <div class="makecomment">
                                <form onsubmit="return false">
                                    <input type="text" placeholder="Make a comment" class="make-control"
                                        id="add-comment">
                                    <button class="btn btn-sm btngreen" type="button" id="add-comment-btn">Add</button>
                                </form>
                            </div>
                            <div class="usercommentbox">
                                @if(!@empty($post->comments))
                                @foreach ($post->comments as $comment)

                                {{-- <div class="usercomment">
                                    <img src="{{ asset($comment->user->profile_image) ?? asset('assets/images/profile.png') }}"
                                alt="profile" width="64" height="64" />
                                <p>{{$comment->comment}}</p>
                                <p>{{$comment->user->display_name}}</p>
                                <p>{{$comment->created_at}}</p>
                            </div> --}}
                            <div class="usercomment row">
                                <div class="col-md-3">
                                    <img src="{{ asset($comment->user->profile_image) ?? asset('assets/images/profile.png') }}"
                                        alt="profile" width="64" height="64" />
                                </div>
                                <div class="col-md-9 row">
                                    <p class="col-md-12"><b>{{$comment->comment}}</b></p>
                                    <p class="col-md-6">{{$comment->user->display_name}}</p>
                                    <p class="col-md-6">{{ date('M d,Y', strtotime($comment->created_at)) }}</p>
                                </div>
                            </div>
                            @endforeach
                            @endif


                        </div>
                    </div>
                </div>
                <div id="review">
                    <div class="reviewbox">
                        @if($post->type == config('constants.Artist') || $post->type ==
                        config('constants.Commisioned'))
                        <div class="destitle">
                            <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100" height="100" />
                            <h2>Artist Username</h2>
                        </div>
                        <div class="artist-rateing">
                            <div class="rateing-title">
                                <span>Very Bad</span>
                                <span>Very Good</span>
                            </div>
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
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == $post->transaction ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
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
                        </div>
                        @endif
                        @if($post->type == config('constants.Commissioner'))
                        <div class="destitle">
                            <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100" height="100" />
                            <h2>Buyer Username</h2>
                        </div>
                        <div class="artist-rateing">
                            <div class="rateing-title">
                                <span>Very Bad</span>
                                <span>Very Good</span>
                            </div>
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
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == $post->price ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
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
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == $post->speed ? 'checked' : NULL) }}>
                                            @endfor
                                    </div>
                                </div>
                            </div>
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
                            <div class="rateing">
                                <h5>Professonalism
                                    <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                        data-placement="top" title="Professonalism"></i>
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
                                                {{ $rating === 0 ? 'disabled checked' : ($rating == $post->professionalism ? 'checked' : NULL) }}>
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
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="login-register">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="loginregistertext">Login</h2>
                                <div class="login-registerwrapper">
                                    <div class="login-register-form">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <input id="post_id" name="post_id" value="{{ $post->id }}" type="hidden" />
                                            <div class="artsinput">
                                                <input id="email" title="Email Address" type="email" name="email"
                                                    value="{{ old('email') ?? NULL }}" placeholder="Email"
                                                    class="arts-control @error('email') border-danger border @enderror"
                                                    autofocus style="margin-bottom: 0;" />
                                                @error('email')
                                                <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="artsinput mt-4 mb-4">
                                                <input id="password" title="Password" type="password" name="password"
                                                    placeholder="Password"
                                                    class="arts-control @error('password') mb-0 @enderror" />
                                                @error('password')
                                                <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="loginbtn">
                                                <button type="button" class="btn btn-danger modal-close">Cancel</button>
                                                <button type="submit" class="btngreen">Login</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
@endsection
@push('scripts')
<script type="text/javascript">
    var loggedIn = {{ auth()->check() ? 'true' : 'false' }};

    function likes(){

        if (loggedIn){
            doLike();
        }else{
            login();
        }
    }

    function curate(){
        if(!loggedIn){
            login();
        }
    }

    function login(){
        $("#modalLogin").modal('show');
    }
    $(".modal-close").on("click",function(){
        $("#modalLogin").modal('hide');
    });

    function doLike(){

        $.ajax({
            url: '/likes',
            data: {
                "_token" : '{{csrf_token()}}',
                "postid": {!! $post->id !!},
            },
            type: 'post',
            success: function(response)
            {
                if (response.status === true) {
                    toastr.success(response.message, 'Success', toastrOptions);
                    if(response.is_like == 1){
                        $(".like").addClass('text-dark');
                    }else{
                        $(".like").removeClass('text-dark');
                    }
                    $(".getLikes").html(response.likes_count);
                } else {
                    toastr.error(response.message, '', toastrOptions);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    function follow(follow_user_id){
        $.ajax({
            url: '/follow',
            data: {
                "_token" : '{{csrf_token()}}',
                "follow_user_id": follow_user_id
            },
            type: 'post',
            success: function(response)
            {
                if (response.status === true) {
                    if(response.is_follow == 1){
                        $(".setDrawnBy").html("Followed");
                    }else{
                        $(".setDrawnBy").html("Follow");
                    }
                    toastr.success(response.message, 'Success', toastrOptions);
                } else {
                    toastr.error(response.message, '', toastrOptions);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    //add comment ajax call
    $("#add-comment-btn").on('click',function(e){
        var comment = $("#add-comment").val();
        var post_id = {!! $post->id !!}
        var token = "{{csrf_token()}}"

        if(comment.length >0 && post_id != null){
            let formData = new FormData();
            formData.append('post_id', post_id);
            formData.append('comment', comment);
            formData.append('_token', token);

            $.ajax({
                url: BASE_URL + '/posts/comment',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response)
                {
                    if (response.status === true) {
                        $("#add-comment").value = "";
                        toastr.success(response.message, 'Success', toastrOptions);
                        window.setTimeout(function(){location.reload()},2000);
                    } else {
                        toastr.error(response.message, '', toastrOptions);
                    }
                },
                error: function(err){
                    $("#add-comment").value = "";
                    console.log(err);
                }
            });
        }
    });
    /* $("#add-comment").keydown(function (e) {
        if(!loggedIn){
            login();
        }else{
            if (e.keyCode == 13) {

                var comment = this.value;
                var post_id = {!! $post->id !!}
                var token = "{{csrf_token()}}"
                if(comment.length >0 && post_id != null){
                    let formData = new FormData();
                    formData.append('post_id', post_id);
                    formData.append('comment', comment);
                    formData.append('_token', token);

                    $.ajax({
                        url: BASE_URL + '/posts/comment',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response)
                        {
                            if (response.status === true) {
                                $("#add-comment").value = "";
                                toastr.success(response.message, 'Success', toastrOptions);
                                window.setTimeout(function(){
                                    location.reload()
                                },2000);
                            } else {
                                toastr.error(response.message, '', toastrOptions);
                            }
                        },
                        error: function(err){
                            $("#add-comment").value = "";
                            console.log(err);
                        }
                    });
                }

            }
        }

    }); */
</script>
@endpush
