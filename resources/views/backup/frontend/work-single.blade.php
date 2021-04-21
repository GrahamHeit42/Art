@extends('frontend.layout.sidebar')

@section('head-part')
<title>MyPortfolio Bootstrap Template - Work</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=https://fonts.googleapis.com/css?family=Inconsolata:400,500,600,700|Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
@endsection

@section('content')
<!-- ======= Navbar ======= -->
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

    <section class="section">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6" data-aos="fade-up">
                    <h2>Work Single Page</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut officiis explicabo inventore.</p>
                </div>
            </div>
        </div>

        <div class="site-section pb-0">
            <div class="container">
                <div class="row align-items-stretch">
                    <div class="col-md-8" data-aos="fade-up">
                        <img src="{{asset('images/img_1_big.jpg')}}" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="sticky-content">
                            <h3 class="h3">Boxed Water</h3>
                            <p class="mb-4"><span class="text-muted">Design</span></p>

                            <div class="mb-5">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores illo, id recusandae molestias
                                    illum unde pariatur, enim tempora.</p>

                            </div>

                            <h4 class="h4 mb-3">What I did</h4>
                            <ul class="list-unstyled list-line mb-5">
                                <li>Design</li>
                                <li>HTML5/CSS3</li>
                                <li>CMS</li>
                                <li>Logo</li>
                            </ul>

                            <p><a href="#" class="readmore">Visit Website</a></p>
                        </div>
                    </div>
                </div>
            </div>
    </section>

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
                    </div><!-- End testimonial item -->

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
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->

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

<!-- frontend JS Files -->
<script src="{{asset('frontend/aos/aos.js')}}"></script>
<script src="{{asset('frontend/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('frontend/php-email-form/validate.js')}}"></script>
<script src="{{asset('frontend/swiper/swiper-bundle.min.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('frontend/js/main.js')}}"></script>

</body>

</html>