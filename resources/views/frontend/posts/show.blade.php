@extends('frontend.layouts.app')
@section('title','Post Details')
@push('styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>
    .disablebtn {
        pointer-events: none;
        cursor: default;
        background-color: gray !important;
        border: 1px solid gray !important;
    }

    .usercomment .usercomment {
        margin-left: 40px;
    }

    .border-left {
        border-left: 8px solid green;
    }

    .make-control {
        text-align: left;
    }
</style>
@endpush

@section('content')
<div id="container" style="padding-top: 5%;">
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
                            class="fas fa-heart"></i> <span class="setLike">@if($post->post_like_by_user == 1) Liked
                            @else Like @endif</span></a>
                    <a href="#" onclick="curate();" class="deccreate button btndarkyellow"><i class="fas fa-copy"></i>
                        Curate</a>

                </div>
                @if(isset($post) && Auth::check() && $post->user_id == Auth::user()->id)
                <div class="mb-4"><a href="{{url('/posts/edit',$post->id)}}" class="btn btn-info">Edit</a></div>
                @endif
                <div id="postdetails">
                    <ul class="posttab row">
                        @if($post->type_id == 1)
                        <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="#description" class="btngreen active"
                                id="desBtn" onclick="btnGreen(this)">Description</a></li>
                        <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="#comments" class="btnyellow"
                                id="commentBtn"
                                onclick="btnYellow(this)">{{($post->getcomments->count()) == 0 ? '' : $post->getcomments->count()}}
                                Comments</a></li>
                        @else
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#description" class="btngreen active"
                                id="desBtn" onclick="btnGreen(this)">Description</a></li>
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#comments" class="btnyellow"
                                id="commentBtn"
                                onclick="btnYellow(this)">{{($post->getcomments->count()) == 0 ? '' : $post->getcomments->count()}}
                                Comments</a></li>
                        <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><a href="#review" class="btndarkyellow"
                                id="reviewBtn" onclick="btndarkYellow(this)">Review</a></li>
                        @endif
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
                                            <img style="width: 60px; height: 60px; border-radius: 50%;"
                                                src="{{ asset($post->drawnBy->user->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->drawnBy->username ?? "Unknown"}}</a>
                                            @if($post->drawnBy->user_id != Auth::id())
                                            <a class="btngreen followbtn @if(empty($post->drawnBy) || empty($post->drawnBy->user_id)) disablebtn @endif @if($post->drwan_by_follow == 1) text-dark @endif"
                                                onclick="follow({{$post->drawnBy->user_id ?? 0}}, this)"><span
                                                    class="setDrawnBy">@if($post->drwan_by_follow
                                                    == 1) Following @else Follow @endif</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($post->commisionedBy))
                                <div class="descuserbox">
                                    <h2>Commisioned by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img style="width: 60px; height: 60px; border-radius: 50%;"
                                                src="{{ asset($post->commisionedBy->user->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->commisionedBy->username ?? "UserName"}}</a>
                                            @if($post->commisionedBy->user_id != Auth::id())
                                            <a class="btngreen followbtn @if(empty($post->commisionedBy) || empty($post->commisionedBy->user_id)) disablebtn @endif @if($post->commisioned_by_follow == 1) text-dark @endif"
                                                onclick="follow({{ $post->commisionedBy->user_id ?? 0}}, this)"><span
                                                    class="setCommisionedBy">@if($post->commisioned_by_follow
                                                    == 1) Following @else Follow @endif</span></a>
                                            @endif
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
                                    <p><i class="fas fa-heart"></i> <span class="getLikes">
                                            <?php
                                        if ($post->likes > 999 && $post->likes <= 999999) { echo $result=number_format($post->likes / 10,1) . 'K' ; }
                                            elseif ($post->likes> 999999) {
                                                echo $result = number_format($post->likes / 10000,1) . 'M';
                                            } else {
                                                echo $result = $post->likes;
                                            }
                                            ?>
                                        </span> Likes
                                    </p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-copy"></i> 000 Curations</p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-eye"></i>
                                        {{-- {{$post->views_count}} --}}
                                        <?php
                                              if ($post->views_count > 999 && $post->views_count <= 999999) {
                                                  echo $result=number_format($post->views_count / 10,1) . 'K' ;
                                                }
                                                elseif ($post->views_count> 999999) {
                                                    echo $result = number_format($post->views_count / 10000,1) . 'M';
                                               } else {
                                                    echo $result = $post->views_count;
                                               }
                                        ?>
                                        Views</p>
                                </div>
                            </div>
                            <div class="socialdes row">
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="" class="btngreen btnfb"><i class="fab fa-facebook-square"></i>
                                        Facebook</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="" class="btngreen btntw"><i class="fab fa-twitter-square"></i> Twitter</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" class="btngreen btnpi"><i class="fab fa-pinterest-square"></i>
                                        Pinterest</a>
                                </div>
                                <div class="fb col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <a href="#" onclick="shareLink()" class="shareLink btngreen"><i
                                            class="fa fa-copy"></i> Share Link</a>
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
                                        ?>
                                <a href="{{url('/?q='.$value)}}" class="btngreen">{{$value}}</a>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="comments">
                        <div class="commentsbox">
                            <div class="destitle">
                                {{-- <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100"
                                height="100" /> --}}
                                <h2>{{$post->title}}</h2>
                            </div>
                            <div class="debox mb-5">
                                @if(!empty($post->drawnBy))
                                <div class="descuserbox">
                                    <h2>Drawn by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img style="width: 60px; height: 60px; border-radius: 50%;"
                                                src="{{ asset($post->drawnBy->user->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->drawnBy->username ?? "Unknown"}}</a>
                                            @if($post->drawnBy->user_id != Auth::id())
                                            <a class="btngreen followbtn @if(empty($post->drawnBy) || empty($post->drawnBy->user_id)) disablebtn @endif @if($post->drwan_by_follow == 1) text-dark @endif"
                                                onclick="follow({{$post->drawnBy->user_id ?? 0}}, this)"><span
                                                    class="setDrawnBy">@if($post->drwan_by_follow
                                                    == 1) Following @else Follow @endif</span></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($post->commisionedBy))
                                <div class="descuserbox">
                                    <h2>Commisioned by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img style="width: 60px; height: 60px; border-radius: 50%;"
                                                src="{{ asset($post->commisionedBy->user->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->commisionedBy->username ?? "UserName"}}</a>
                                            @if($post->commisionedBy->user_id != Auth::id())
                                            <a class="btngreen followbtn @if(empty($post->commisionedBy) || empty($post->commisionedBy->user_id)) disablebtn @endif @if($post->commisioned_by_follow == 1) text-dark @endif"
                                                onclick="follow({{ $post->commisionedBy->user_id ?? 0}}, this)"><span
                                                    class="setCommisionedBy">@if($post->commisioned_by_follow
                                                    == 1) Following @else Follow @endif</span></a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                @endif

                            </div>
                            {{--                             <div class="makecomment">
                                <form onsubmit="return false">
                                    <input type="text" placeholder="Make a comment" class="make-control"
                                        id="add-comment">
                                    <button class="btn btn-sm btngreen" type="button" id="add-comment-btn">Add</button>
                                </form>
                            </div> --}}
                            <div class="makecomment">
                                <form onsubmit="return false" class="row-wrap">
                                    <input type="text" placeholder="Make a comment" class="make-control"
                                        id="add-comment">
                                    <button class="btn btn-sm btngreen w-10-p" type="button"
                                        id="add-comment-btn">Add</button>
                                </form>
                            </div>
                            <div class="usercommentbox">
                                @if(!@empty($post->comments))
                                {{-- @foreach ($post->comments as $comment)
                                <div class="usercomment row">
                                    <div class="col-md-3 user-image">
                                        <img src="{{(!empty($comment->user->profile_image)) ? asset($comment->user->profile_image) : asset('assets/images/profile.png') }}"
                                alt="profile" width="64" height="64" />
                            </div>
                            <div class="col-md-9 row">
                                <p class="col-md-12"><b>{{$comment->comment}}</b></p>
                                <p class="col-md-6">{{$comment->user->display_name}}</p>
                                <p class="col-md-6">{{ date('M d,Y', strtotime($comment->created_at)) }}</p>
                            </div>

                            <div class="col-md-12">
                                <form method="post" action="{{ url('/posts/comment') }}" id="commentForm">
                                    @csrf
                                    <div class="form-group row">
                                        <input type="text" name="comment" class="form-control w-70-p" id="comment" />
                                        <input type="hidden" name="post_id" value="{{ $post->id }}"
                                            id="comment_post_id" />
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}"
                                            id="comment_id" />

                                        <input type="button" class="btn btn-sm btn-outline-danger py-0 w-30-p"
                                            id="commentFormBtn" style="font-size: 0.8em;" value="Reply" />
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                @if(!empty($comment->replies))
                                @foreach ($comment->replies as $reply)
                                <div class="col-md-3">
                                    <img src="{{(!empty($reply->user->profile_image)) ? asset($reply->user->profile_image) : asset('assets/images/profile.png') }}"
                                        alt="profile" width="64" height="64" />
                                </div>
                                <div class="col-md-9 row">
                                    <p class="col-md-12"><b>{{$reply->comment}}</b></p>
                                    <p class="col-md-6">{{$reply->user->display_name}}</p>
                                    <p class="col-md-6">{{ date('M d,Y', strtotime($reply->created_at)) }}</p>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @endforeach --}}
                        @include('frontend.posts.partials.replies', ['comments'=>
                        $post->comments,'post_id'=>$post->id])
                        @endif

                    </div>

                </div>
            </div>
            <div id="review">
                <div class="reviewbox">
                    <div class="debox">
                        @if(!empty($post->drawnBy))
                        <div class="descuserbox">
                            <h2>Drawn by:</h2>
                            <div class="desusercaption">
                                <a href="">
                                    <img style="width: 60px; height: 60px; border-radius: 50%;"
                                        src="{{ asset($post->drawnBy->user->profile_image ?? 'assets/images/user.png') }}"
                                        alt="user" />
                                </a>
                                <div class="descuerbox">
                                    <a class="desuername">{{$post->drawnBy->username ?? "Unknown"}}</a>
                                    @if($post->drawnBy->user_id != Auth::id())
                                    <a class="btngreen followbtn @if(empty($post->drawnBy) || empty($post->drawnBy->user_id)) disablebtn @endif @if($post->drwan_by_follow == 1) text-dark @endif"
                                        onclick="follow({{$post->drawnBy->user_id ?? 0}}, this)"><span
                                            class="setDrawnBy">@if($post->drwan_by_follow
                                            == 1) Following @else Follow @endif</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($post->commisionedBy))
                        <div class="descuserbox">
                            <h2>Commisioned by:</h2>
                            <div class="desusercaption">
                                <a href="">
                                    <img style="width: 60px; height: 60px; border-radius: 50%;"
                                        src="{{ asset($post->commisionedBy->user->profile_image ?? 'assets/images/user.png') }}"
                                        alt="user" />
                                </a>
                                <div class="descuerbox">
                                    <a class="desuername">{{$post->commisionedBy->username ?? "UserName"}}</a>
                                    @if($post->commisionedBy->user_id != Auth::id())
                                    <a class="btngreen followbtn @if(empty($post->commisionedBy) || empty($post->commisionedBy->user_id)) disablebtn @endif @if($post->commisioned_by_follow == 1) text-dark @endif"
                                        onclick="follow({{ $post->commisionedBy->user_id ?? 0}}, this)"><span
                                            class="setCommisionedBy">@if($post->commisioned_by_follow
                                            == 1) Following @else Follow @endif</span></a>
                                    @endif
                                </div>

                            </div>
                        </div>
                        @endif
                    </div>
                    @if($post->type == config('constants.Commisioned'))
                    {{-- <div class="destitle">
                            <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100" height="100" />
                    <h2>Artist Username</h2>
                </div> --}}
                <div class="artist-rateing">
                    <div class="rateing-title">
                        <span>Very Bad</span>
                        <span>Very Good</span>
                    </div>
                    <div class="rateing">
                        <h5>Transaction
                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                title="Transaction"></i>
                        </h5>
                        <div id="full-stars-example-two">
                            <div class="rating-group">
                                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                    <label aria-label="{{ $rating }} star" class="rating__label"
                                        for="transaction-{{ $rating }}">
                                        <i class="fa fa-star" @if($post->transaction >= $rating)style="color: orange; "
                                            @else style="color:#ddd;" @endif></i>
                                    </label>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <div class="rateing">
                        <h5>Speed
                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                title="Speed"></i>
                        </h5>
                        <div id="full-stars-example-two">
                            <div class="rating-group">
                                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                    <label aria-label="{{ $rating }} star" class="rating__label"
                                        for="speed-{{ $rating }}">
                                        <i class="fa fa-star" @if($post->speed >= $rating)style="color: orange; " @else
                                            style="color:#ddd;" @endif></i>
                                    </label>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <div class="rateing">
                        <h5>Communication
                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                title="Communication"></i>
                        </h5>
                        <div id="full-stars-example-two">
                            <div class="rating-group">
                                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                    <label aria-label="{{ $rating }} star" class="rating__label"
                                        for="communication-{{ $rating }}">
                                        <i class="fa fa-star" @if($post->communication >= $rating)style="color: orange;
                                            " @else style="color:#ddd;" @endif></i>
                                    </label>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <div class="rateing">
                        <h5>Prepertion / Concept
                            <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                                title="Prepertion / Concept"></i>
                        </h5>
                        <div id="full-stars-example-two">
                            <div class="rating-group">
                                @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                    <label aria-label="{{ $rating }} star" class="rating__label"
                                        for="concept-{{ $rating }}">
                                        <i class="fa fa-star" @if($post->concept >= $rating)style="color: orange; "
                                            @else style="color:#ddd;" @endif></i>
                                    </label>
                                    @endif
                                    @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($post->type == config('constants.Commissioner'))
                {{-- <div class="destitle">
                        <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100" height="100" />
                <h2>Buyer Username</h2>
            </div> --}}
            <div class="artist-rateing">
                <div class="rateing-title">
                    <span>Very Bad</span>
                    <span>Very Good</span>
                </div>
                <div class="rateing">
                    <h5>Price
                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                            title="Price"></i>
                    </h5>
                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                <label aria-label="{{ $rating }} star" class="rating__label" for="price-{{ $rating }}">
                                    <i class="fa fa-star" @if($post->price >= $rating)style="color: orange; " @else
                                        style="color:#ddd;" @endif></i>
                                </label>
                                @endif
                                @endfor
                        </div>
                    </div>
                </div>
                <div class="rateing">
                    <h5>Speed
                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                            title="Speed"></i>
                    </h5>
                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                <label aria-label="{{ $rating }} star" class="rating__label" for="speed-{{ $rating }}">
                                    <i class="fa fa-star" @if($post->speed >= $rating)style="color: orange; " @else
                                        style="color:#ddd;" @endif></i>
                                </label>
                                @endif
                                @endfor
                        </div>
                    </div>
                </div>
                <div class="rateing">
                    <h5>Quality
                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                            title="Quality"></i>
                    </h5>
                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                <label aria-label="{{ $rating }} star" class="rating__label"
                                    for="quality-{{ $rating }}">
                                    <i class="fa fa-star" @if($post->quality >= $rating)style="color: orange; " @else
                                        style="color:#ddd;" @endif></i>
                                </label>
                                @endif
                                @endfor
                        </div>
                    </div>
                </div>
                <div class="rateing">
                    <h5>Professonalism
                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                            title="Professonalism"></i>
                    </h5>

                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                <label aria-label="{{ $rating }} star" class="rating__label"
                                    for="professionalism-{{ $rating }}">
                                    <i class="fa fa-star" @if($post->professionalism >= $rating)style="color: orange; "
                                        @else style="color:#ddd;" @endif></i>
                                </label>
                                @endif

                                @endfor
                        </div>
                    </div>

                </div>
                <div class="rateing">
                    <h5>Communication
                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top"
                            title="Communication"></i>
                    </h5>
                    <div id="full-stars-example-two">
                        <div class="rating-group">
                            @for($rating = 0; $rating <= 5; $rating++) @if($rating> 0)
                                <label aria-label="{{ $rating }} star" class="rating__label"
                                    for="communication-{{ $rating }}">
                                    <i class="fa fa-star" @if($post->communication >= $rating)style="color: orange; "
                                        @else style="color:#ddd;" @endif></i>
                                </label>
                                @endif
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
    $(document).ready(function() {
        // $('.owl-prev').hide();
        // $('.owl-next').click(function() {
        //     $('.owl-prev').show();
        // });
        // $('.owl-prev').click(function() {
        //     $('.owl-prev').show();
        // });

    });
    var loggedIn = {{ auth()->check() ? 'true' : 'false' }};

    function btnYellow(t){
        //comment section
        $("#desBtn").removeClass('active');
        $("#reviewBtn").removeClass('active');
        $("#commentBtn").removeClass('active');
        $(t).addClass('active');
    }
    function btndarkYellow(t){
        //review
        $("#desBtn").removeClass('active');
        $("#reviewBtn").removeClass('active');
        $("#commentBtn").removeClass('active');
        $(t).addClass('active');
    }
    function btnGreen(t){
        //description
        $("#desBtn").removeClass('active');
        $("#reviewBtn").removeClass('active');
        $("#commentBtn").removeClass('active');
        $(t).addClass('active');
    }
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
                        $(".setLike").html('Liked');
                    }else{
                        $(".like").removeClass('text-dark');
                        $(".setLike").html('Like');
                    }
                    var likes_count = nFormatter(response.likes_count);
                    $(".getLikes").html(likes_count);
                } else {
                    toastr.error(response.message, '', toastrOptions);
                }
            },
            error: function(err){
                console.log(err);
            }
        });
    }

    function follow(follow_user_id, t){
        if(!loggedIn){
            login();
        }else{
            $.ajax({
                url: '{{ url("follow") }}',
                data: {
                    "_token" : '{{csrf_token()}}',
                    "follow_user_id": follow_user_id
                },
                type: 'post',
                success: function(response)
                {
                    if (response.status === true) {
                        if(parseInt(response.is_follow) === 1){
                            var drawnBy =  $(t).find(".setDrawnBy");
                            var commissionedBy = $(t).find(".setCommisionedBy");
                            if(drawnBy.length){
                                $(".setDrawnBy").html("Following");
                                $(".setDrawnBy").addClass('text-dark');
                            }
                            if(commissionedBy.length){
                                $(".setCommisionedBy").html("Following");
                                $(".setCommisionedBy").addClass('text-dark');
                            }
                            // if($(t).find(".setDrawnBy")){
                            //     $(".setDrawnBy").html("Following");
                            //     $(".setDrawnBy").addClass('text-dark');
                            // }
                            // if($(t).find(".setCommisionedBy")){
                            //     $(".setCommisionedBy").html("Following");
                            //     $(".setCommisionedBy").addClass('text-dark');
                            // }
                            // $(t).find(".setDrawnBy").html("Following");
                            // $(t).find(".setDrawnBy").addClass('text-dark');
                            // $(t).find(".setCommisionedBy").html("Following");
                            // $(t).find(".setCommisionedBy").addClass('text-dark');
                        }else{
                            var drawnBy =  $(t).find(".setDrawnBy");
                            var commissionedBy = $(t).find(".setCommisionedBy");
                            if(drawnBy.length){
                                $(".setDrawnBy").html("Follow");
                                $(".setDrawnBy").removeClass('text-dark');
                                $(".setDrawnBy").addClass('text-light');
                            }
                            if(commissionedBy.length){
                                $(".setCommisionedBy").html("Follow");
                                $(".setCommisionedBy").removeClass('text-dark');
                                $(".setCommisionedBy").addClass('text-light');
                            }
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
    }

    function nFormatter(num) {
        if(num > 999 && num < 1000000){
            return (num/10).toFixed(1) + 'K' ;
        }else if(num> 1000000){
            return (num/10000).toFixed(1) + 'M';
        }else if(num < 900){
            return num;
        }
        // if(num > 999 && num < 1000000){
        //     return (num/1000).toFixed(1) + 'K' ;
        // }else if(num> 1000000){
        //     return (num/1000000).toFixed(1) + 'M';
        // }else if(num < 900){
        //     return num;
        // }
    }

    $("#commentFormBtn").on('click',function(){

        if(!loggedIn){
            login();
        }else{
            var token = "{{csrf_token()}}";
            var post_id = $('#comment_post_id').val();
            var comment_id = $('#comment_id').val();
            var comment = $('#comment').val();

            let formData = new FormData();
            formData.append('post_id', post_id);
            formData.append('comment_id', comment_id);
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
                        toastr.success(response.message, 'Success', toastrOptions);
                        window.setTimeout(function(){location.reload()},2000);
                    } else {
                        toastr.error(response.message, '', toastrOptions);
                    }
                },
                error: function(err){
                    onsole.log(err);
                }
            });
        }
    });

    //add comment ajax call
    $("#add-comment-btn").on('click',function(e){
        if(!loggedIn){
            login();
        }else{

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
        }
    });
    function shareLink() {
        var $temp = $("<input>");
        $("body").append($temp);
        var url = BASE_URL + '/posts/'+ {{$post->id}};
        $temp.val(url).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
@endpush
