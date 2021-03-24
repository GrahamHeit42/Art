@extends('frontend.layout.sidebar')

@section('head-part')
<title>MyPortfolio Bootstrap Template - Index</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
@endsection

@section('content')
<div class="logo-header">
    <div class="container-fluid">
        <div class="logo">
            <img src="{{asset('frontend/icon/logo.svg')}}" alt="">
            <span>Art Habor</span>
        </div>
        <div class="Search-box">
            <input type="text" id="box" placeholder="Search anything..." class="search__box">
        </div>
        <div class="login-reg">
            <button class="btn btn-success" type="button">Register</button>
            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</button>
        </div>
    </div>
</div>
<!-- ======= Navbar ======= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Subscriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Arts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blogs</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main id="main">
    <!-- ======= Works Section ======= -->
    <section class="section site-portfolio">
        <div class="container-fluid">
            <div class="row mb-5 align-items-center">
                <div class="col-md-12 col-lg-12 text-start" data-aos="fade-up" data-aos-delay="100">
                    <div id="filters" class="filters">
                        <a href="#" data-filter="*" class="active">Commissions</a>
                        <a href="#" data-filter=".web">2D</a>
                        <a href="#" data-filter=".design">3D</a>
                        <a href="#" data-filter=".branding">Paintings</a>
                        <a href="#" data-filter=".photography">----</a>
                        <a href="#" data-filter=".photography">----</a>
                        <a href="#" data-filter=".photography">----</a>
                    </div>
                </div>
            </div>
            <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
                <div class="item web col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Boxed Water</h3>
                            <span>Web</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_1.jpg')}}">
                    </a>
                </div>
                <div class="item photography col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Build Indoo</h3>
                            <span>Photography</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_2.jpg')}}">
                    </a>
                </div>
                <div class="item branding col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Cocooil</h3>
                            <span>Branding</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_3.jpg')}}">
                    </a>
                </div>
                <div class="item design col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Nike Shoe</h3>
                            <span>Design</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_4.jpg')}}">
                    </a>
                </div>
                <div class="item photography col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Kitchen Sink</h3>
                            <span>Photography</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_5.jpg')}}">
                    </a>
                </div>
                <div class="item branding col-sm-6 col-md-4 col-lg-4 mb-4">
                    <a href="work-single.html" class="item-wrap fancybox">
                        <div class="work-info">
                            <h3>Amazon</h3>
                            <span>brandingn</span>
                        </div>
                        <img class="img-fluid" src="{{asset('images/img_6.jpg')}}">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- End  Works Section -->
    <!-- ======= Clients Section ======= -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-5">
                    <h3 class="h3 heading">My Clients</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-adobe.png')}}" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-uber.png')}}" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-apple.png')}}" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-netflix.png')}}" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-nike.png')}}" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-4 col-sm-4 col-md-2">
                    <a href="#" class="client-logo"><img src="{{asset('images/logo-google.png')}}" alt="Image" class="img-fluid"></a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Clients Section -->
    <!-- ======= Services Section ======= -->
    <section class="section services">
        <div class="container">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-5">
                    <h3 class="h3 heading">My Services</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <i class="bi bi-card-checklist"></i>
                    <h4 class="h4 mb-2">Web Design</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <i class="bi bi-binoculars"></i>
                    <h4 class="h4 mb-2">Mobile Applications</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <i class="bi bi-brightness-high"></i>
                    <h4 class="h4 mb-2">Graphic Design</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <i class="bi bi-calendar4-week"></i>
                    <h4 class="h4 mb-2">SEO</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit explicabo inventore.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->
    <!-- ======= Testimonials Section ======= -->
    <section class="section pt-0">
        <div class="container">
            <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial">
                                <img src="{{asset('images/person_1.jpg')}}" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut officiis
                                        explicabo inventore.</p>
                                </blockquote>
                                <p>&mdash; Jean Hicks</p>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-wrap">
                            <div class="testimonial">
                                <img src="{{asset('images/person_2.jpg')}}" alt="Image" class="img-fluid">
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut officiis
                                        explicabo inventore.</p>
                                </blockquote>
                                <p>&mdash; Chris Stanworth</p>
                            </div>
                        </div>
                    </div>
                    <!-- End testimonial item -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->
</main>
<!-- End #main -->

<!-- popup modal  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="sign-in-form">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="" target="_blank">Forgot password?</a>
                        </div>
                        <div class="col-md-6 registration-page">
                            <a href="" target="_blank">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Sign In</button>
            </div>
        </div>
    </div>
</div>
@endsection