@extends('frontend.layouts.app')
@section('title','Post Details')
@push('styles')
<style>
    .disablebtn {
        cursor: none !important;
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
                    <a href="#" class="button btngreen like"><i class="fas fa-heart"></i> Like</a>
                    <a href="#" class="deccreate button btndarkyellow"><i class="fas fa-copy"></i> Curate</a>

                </div>
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
                                <div class="descuserbox">
                                    <h2>Drawn by:</h2>
                                    <div class="desusercaption">
                                        {{-- <a href="">
                                            <img src="{{ asset('assets/images/user.png') }}" alt="user" width="100"
                                        height="100" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">User Name</a>
                                            <a class="btngreen followbtn" href="#">Follow</a>
                                        </div> --}}
                                        <a href="">
                                            <img src="{{ asset($post->drawnBy->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" width="100" height="100" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->drawnBy->username ?? "UserName"}}</a>
                                            <a class="btngreen followbtn @if(empty($post->drawnBy)) disablebtn @endif"
                                                onclick="follow({{$post->drawnBy->id ?? 0}})">Follow</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="descuserbox">
                                    <h2>Commisioned by:</h2>
                                    <div class="desusercaption">
                                        <a href="">
                                            <img src="{{ asset($post->commisionedBy->profile_image ?? 'assets/images/user.png') }}"
                                                alt="user" width="100" height="100" />
                                        </a>
                                        <div class="descuerbox">
                                            <a class="desuername">{{$post->commisionedBy->username ?? "UserName"}}</a>
                                            <a class="btngreen followbtn @if(empty($post->commisionedBy)) disablebtn @endif"
                                                onclick="follow({{ $post->commisionedBy->id ?? 0}})">Follow</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="desinfo">
                                <p>{{$post->description}}</p>
                            </div>

                            <div class="despostdate">
                                <p>Posted: {{ date('M d,Y', strtotime($post->created_at)) }}</p>
                            </div>
                            <div class="likeviewcur">
                                <div class="deslike">
                                    <p><i class="fas fa-heart"></i> 000 Likes</p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-copy"></i> 000 Curations</p>
                                </div>
                                <div class="deslike">
                                    <p><i class="fas fa-eye"></i> 000 Views</p>
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
                                <input type="text" placeholder="Make a comment" disabled class="make-control">
                            </div>
                            <div class="usercommentbox">
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                                <div class="usercomment">
                                    <img src="{{ asset('assets/images/profile.png') }}" alt="profile" width="64"
                                        height="64" />
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                        molestiae quas vel </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="review">
                        <div class="reviewbox">
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
                                <div class="rateing">
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
                                <div class="rateing">
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
                                <div class="rateing">
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
                            </div>
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
                                <div class="rateing">
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
                                <div class="rateing">
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
                                <div class="rateing">
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
                                <div class="rateing">
                                    <h5>Communication
                                        <i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip"
                                            data-placement="top" title="Communication"></i>
                                    </h5>
                                    <div id="full-stars-example-two">
                                        <div class="rating-group">
                                            <input disabled checked class="rating__input rating__input--none"
                                                name="rating5" id="rating5-none" value="0" type="radio">
                                            <label aria-label="1 star" class="rating__label" for="rating5-1">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            <input class="rating__input" name="rating5" id="rating5-1" value="1"
                                                type="radio">
                                            <label aria-label="2 stars" class="rating__label" for="rating5-2">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            <input class="rating__input" name="rating5" id="rating5-2" value="2"
                                                type="radio">
                                            <label aria-label="3 stars" class="rating__label" for="rating5-3">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            <input class="rating__input" name="rating5" id="rating5-3" value="3"
                                                type="radio">
                                            <label aria-label="4 stars" class="rating__label" for="rating5-4">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            <input class="rating__input" name="rating5" id="rating5-4" value="4"
                                                type="radio">
                                            <label aria-label="5 stars" class="rating__label" for="rating5-5">
                                                <i class="rating__icon rating__icon--star fa fa-star"></i>
                                            </label>
                                            <input class="rating__input" name="rating5" id="rating5-5" value="5"
                                                type="radio">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

</script>
@endpush
