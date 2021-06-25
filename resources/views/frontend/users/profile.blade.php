@extends('layouts.app')
@section('title','Profile')
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/user-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('content')
<div id="wrapper">
<!-- Main section css  -->
<div id="main">
   <div class="user-profile">
     <div class="user-banner" style="background-image: url({{asset('assets/images/gallery/post-66.jpg')}});">
        <div class="container-fluid">
          <div class="d-flex justify-content-between flex-wrap">
            <div class="user-dital">
          <div class="user-info">
            <div class="user-img">
              <img src="{{asset('assets/images/gallery/post-19.png')}}">
            </div>
          </div>
          <div class="user-name">
            <h3>User name</h3>
            <p>sub title</p>
          </div>
        </div>
          <div class="edit-user">
            <a href="#" class="btn" data-target="#edit-profile" data-toggle="modal"><i class="fa fa-pencil"></i>Edit profile</a>
          </div>
          </div>
        </div>
   </div>
</div>

<section class="user-portfoliyo">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-lg-4  borer-green">
        <div class="user-sociat-tital bg-green">
          <h2>Commission Me</h2>
        </div>
        <div class="user-sociat-info">
           <p class="social-tital text-green text-center">Find me on:</p>
           <div class="social-media-icon">
             <ul>
               <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-yelp" aria-hidden="true"></i></a></li>
             </ul>
           </div>
           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
      </div>
      <div class="col-lg-8">
         <div class="our-portfoliyo">
          <div class="portfoliy-tab">
            <ul>
              <li><a href="#">Gallary</a></li>
              <li><a href="#">Posts</a></li>
              <li><a href="#">Commissions</a></li>
              <li><a href="#">Like</a></li>
              <li><a href="#">Review</a></li>
            </ul>
          </div>
         </div>
      </div>
    </div>
  </div>
</section>
<!-- Main section css  -->
<!-- Footer  -->
<footer id="footer">
    <div class="row">
        <div class="col-lg-8">
            <div class="usefull-link">
                <ul>
                    <li>
                        <a href="terms-and-conditions.html">Terms and conditions</a>
                    </li>
                    <li>
                        <a href="faq.html">Help & FAQ</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="realeyze">
                <p>©2021 <a href="#">Realeyze</a> | Version 1.0.0</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer  -->
</div>
<!-- popup modal  -->
<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">My Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div class="edit-profile-tab">
             <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Bio</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile Pic</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Social</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  <div class="row no-gutters">
                    <div class="col-lg-3  borer-green">
                      <div class="edit-profile-left">
                        <a href="#" class="btn text-green">Upload</a>
                        <ul class="nav flex-column left-nav">
                          <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="all-img">
                           <h3 class="p-4 text-left">Gallery</h3>
                          <div class="row no-gutters">
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>

                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><div class="row no-gutters">
                    <div class="col-lg-3  borer-green">
                      <div class="edit-profile-left">
                        <a href="#" class="btn text-green">Upload</a>
                        <ul class="nav flex-column left-nav">
                          <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="all-img">
                           <h3 class="p-4 text-left">Gallery</h3>
                          <div class="row no-gutters">
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>

                          </div>
                        </div>
                    </div>
                  </div></div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><div class="row no-gutters">
                    <div class="col-lg-3  borer-green">
                      <div class="edit-profile-left">
                        <a href="#" class="btn text-green">Upload</a>
                        <ul class="nav flex-column left-nav">
                          <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="all-img">
                           <h3 class="p-4 text-left">Gallery</h3>
                          <div class="row no-gutters">
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                            <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>
                           <div class="col-lg-3 col-md-4 col-4">
                              <img  src="{{asset('assets/images/gallery/post-1.png')}}"/>
                            </div>

                          </div>
                        </div>
                    </div>
                  </div></div>
              </div>
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cancel bg-green">Select</button>
        </div>
      </div>
    </div>
</div>
<!-- popup modal -->
<div class="modal fade upload-popup" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="popup-btn">
                        <a href="#" class="btn gallery-btn-green" onclick="myFunction()">Artist</a>
                        <span>OR</span>
                        <a href="commissoner.html" class="btn gallery-btn-dark-yellow">Commissioner</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="popup-option">
                        <a href="artist.html" class="btn gallery-btn-dark-yellow">Personal</a>
                        <span>OR</span>
                        <a href="#" class="btn gallery-btn-dark-yellow">Commissioned</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
</div>
@endsection

