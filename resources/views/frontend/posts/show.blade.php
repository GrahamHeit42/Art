@extends('frontend.layouts.app')
@section('title','Post Details')
@section('content')
<div id="main">
    <div class="post-banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner">
                        <img src="{{asset('images/gallery/post-banner-1.png')}}" alt="post banner">
                    </div>
                    <div class="banner-info">
                        <div class="post-artist">
                            <div class="artist-name">
                                <i class="fa fa-smile-o" aria-hidden="true"></i>
                                <h3>Artist Name</h3>
                            </div>
                            <div class="artist-mail">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                <a href="">Artist@com</a>
                            </div>
                        </div>
                        <div class="post-like">
                            <p>98 %</p>
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post-wrapper">
        <div class="row">
            <div class="col-lg-4">
                <div class="post-artist-info">
                    <div class="description-box">
                        <a href="" class="btn gallery-btn-green">Description</a>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                            molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                            numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                            optio, eaque rerum! Provident similique accusantium nemo autem.</p>
                    </div>
                    <div class="social-media">
                        <ul>
                            <li>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    <span>Twitter</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span>Instagram</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    <span>Website</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="gallery">
                    <div class="gallery-tab">
                        <div class="container">
                            <div class="row no-spacing">
                                <div class="col-lg-12 col-md-12 no-spacing">
                                    <div class="tab-button nav" id="nav-tab" role="tablist">
                                        <a class="btn gallery-btn-green active" id="nav-commissions-tab" data-toggle="tab" href="#nav-commissions" role="tab" aria-controls="nav-commissions" aria-selected="true">Commissions</a>
                                        <a class="btn gallery-btn-dark-yellow" id="nav-lllustration-tab" data-toggle="tab" href="#nav-lllustration" role="tab" aria-controls="nav-lllustration" aria-selected="false">lllustration</a>
                                        <a class="btn gallery-btn-yellow" id="nav-2d-tab" data-toggle="tab" href="#nav-2d" role="tab" aria-controls="nav-2d" aria-selected="false">2D</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="post tab-pane fade show active" id="nav-commissions" role="tabpanel" aria-labelledby="nav-commissions-tab">
                            <div class="page-type">
                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-1.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-2.png')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-3.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-4.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-5.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-6.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-7.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-8.png')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-9.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-10.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-11.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-12.png')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-13.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-14.png')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-15.png')}}" />
                                </a>

                                <a href="#" class="big">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-16.png')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-17.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-18.png')}}" />
                                </a>
                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-19.png')}}" />
                                </a>
                            </div>
                        </div>
                        <div class="post tab-pane fade" id="nav-lllustration" role="tabpanel" aria-labelledby="nav-lllustration-tab">
                            <div class="page-type">
                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-20.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-21.png')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-22.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-23.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-24.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-25.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-26.png')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-27.png')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-28.png')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-29.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-30.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-31.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-32.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-33.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-34.jpg')}}" />
                                </a>

                                <a href="#" class="big">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-35.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-36.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-37.jpg')}}" />
                                </a>
                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-38.jpg')}}" />
                                </a>
                            </div>
                        </div>
                        <div class="post tab-pane fade" id="nav-2d" role="tabpanel" aria-labelledby="nav-2d-tab">
                            <div class="page-type">
                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-39.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-40.jpg')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-41.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-42.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-43.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-44.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-45.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-46.jpg')}}" />
                                </a>

                                <a href="#" class="vertical">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-47.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-48.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-49.jpg')}}" />
                                </a>

                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-50.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-51.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-52.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-53.jpg')}}" />
                                </a>

                                <a href="#" class="big">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-54.jpg')}}" />
                                </a>

                                <a href="#">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-55.jpg')}}" />
                                </a>

                                <a href="#" class="horizontal">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-56.jpg')}}" />
                                </a>
                                <a href="#" class="small">
                                    <img class="animate__animated animate__zoomIn" src="{{asset('images/gallery/post-57.jpg')}}" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
