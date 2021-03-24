@extends('frontend.layout.sidebar')

@section('head-part')
<title>MyPortfolio Bootstrap Template - About</title>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=https://fonts.googleapis.com/css?family=Inconsolata:400,500,600,700|Raleway:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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
    <section class="section pb-5">
        <div class="container">
            <div class="row mb-5 align-items-end">
                <div class="col-md-6" data-aos="fade-up">

                    <h2>About Me</h2>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam necessitatibus incidunt ut
                        officiis explicabo inventore.</p>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 ml-auto order-2" data-aos="fade-up">
                    <h3 class="h3 mb-4">Skills</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>WordPress</strong>
                                <span class="ml-auto">80%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>Photoshop</strong>
                                <span class="ml-auto">96%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 96%" aria-valuenow="96" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>HTML5/CSS3</strong>
                                <span class="ml-auto">99%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 99%" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>Veu</strong>
                                <span class="ml-auto">87%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 87%" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>Angular</strong>
                                <span class="ml-auto">85%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex mb-1">
                                <strong>React</strong>
                                <span class="ml-auto">88%</span>
                            </div>
                            <div class="progress custom-progress">
                                <div class="progress-bar" role="progressbar" style="width: 88%" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-md-7 mb-5 mb-md-0" data-aos="fade-up">
                    <p><img src="{{asset('images/person_1_sq.jpg')}}" alt="Image" class="img-fluid"></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor dignissimos delectus minima reprehenderit
                        molestias illo dolorem et, odio!</p>
                    <p>Fuga fugit distinctio delectus iure vitae consequatur excepturi, mollitia, consectetur molestias sapiente
                        rem consequuntur, illum adipisci, sed obcaecati!</p>
                    <p>Ex, dolorem qui voluptas reprehenderit provident, ad ipsum iure a consequatur voluptatem incidunt nobis.
                        Vitae reiciendis quae ex.</p>
                    <p>Optio consectetur culpa nemo, fugit pariatur veniam voluptate laudantium rerum fuga dolor in maiores ea
                        nisi voluptatibus. Minus?</p>
                    <p><a href="#" class="readmore">Download my CV</a></p>
                </div>

            </div>

        </div>

    </section>

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
@endsection