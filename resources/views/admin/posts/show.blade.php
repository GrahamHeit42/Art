@extends('admin.layouts.app')

@push('stylesheets')
<style>
    .row>.column {
        padding: 0 8px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .column {
        float: left;
        width: 25%;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        /* z-index: 1; */
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    .mySlides {
        display: none;
    }

    .cursor {
        cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    img {
        /* margin-bottom: -4px; */
    }

    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    .demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .checked {
        color: orange;
    }
</style>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        @if(isset($post))
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{(!empty($post->cover_image)) ? asset($post->cover_image) : asset('assets/images/noimage.jpg')}}"
                                alt="Picture">
                        </div>

                        <h3 class="profile-username text-center">{{$post->title ?? ''}}</h3>

                        <p class="text-muted text-center">{{$post->user->display_name ?? ''}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Drawn By</b> <a class="float-right">{{$post->drawnBy->username ?? ''}}</a>
                            </li>
                            @if(!empty($post->commisionedBy))
                            <li class="list-group-item">
                                <b>Commisioned By</b> <a
                                    class="float-right">{{$post->commisionedBy->username ?? ''}}</a>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <b>Likes</b> <a class="float-right">{{count($post->likes) ?? 0}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Views</b> <a class="float-right">{{$post->views->sum('count') ?? 0}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Comments</b> <a class="float-right">{{count($post->comments) ?? 0}}</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal-info" data-toggle="tab">Post
                                    Info</a></li>
                            <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#review" data-toggle="tab">Review</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#comments" data-toggle="tab">Comments</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal-info">
                                <!-- Post -->
                                <div class="post">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <p class="col-form-label">{{$post->description}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Subject</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$post->subject->title}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Medium</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$post->medium->title}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Keywords</label>
                                        <div class="col-sm-10">
                                            <p class="col-form-label">{{$post->keywords}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Maturity Rating</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$post->maturity_rating_text}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 row">
                                            <label class="col-sm-5 col-form-label">Status</label>
                                            <div class="col-sm-7">
                                                <p class="col-form-label">{{$post->status_text}}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.post -->

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="gallery">
                                <div class="row">
                                    @if(!empty($post->images))
                                    @foreach ($post->images as $image)
                                    <div class="column">
                                        <img src="{{asset($image->image_path)}}"
                                            onclick="openModal();currentSlide({{$loop->index+1}})"
                                            class="hover-shadow cursor" width="100" height="100" />
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div id="myModal" class="modal">
                                    <span class="close cursor" onclick="closeModal()">&times;</span>
                                    <div class="modal-content h-50">

                                        @foreach ($post->images as $image)
                                        <div class="mySlides">
                                            <div class="numbertext">{{$loop->index+1}} / {{$loop->count}}</div>
                                            <img src="{{asset($image->image_path)}}" style="width:100%;height:500px">
                                        </div>
                                        @endforeach


                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                        <div class="caption-container">
                                            <p id="caption"></p>
                                        </div>

                                        <div class="row">
                                            @foreach ($post->images as $image)
                                            <div class="column col-md-3">
                                                <img class="demo cursor" src="{{asset($image->image_path)}}"
                                                    style="width:100%;height:200px;"
                                                    onclick="currentSlide({{$loop->index+1}})" alt="">
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="review">
                                <div class="row">
                                    @if($post->price != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Price</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<=$post->price) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($post->speed != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Speed</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<$post->speed) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- </div>
                                <div class="row"> --}}
                                    @if($post->quality != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Quality</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<=$post->quality) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($post->communication != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Communication</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<$post->communication) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- </div>
                                <div class="row"> --}}
                                    @if($post->transaction != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Transaction</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<=$post->transaction) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($post->concept != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Concept</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<$post->concept) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($post->understanding != 0)
                                    <div class="col-md-6 row">
                                        <label class="col-sm-5 col-form-label">Understanding</label>
                                        <div class="col-sm-7">
                                            <p class="col-form-label">
                                                @for ($i=0;$i<5;$i++) <span
                                                    class="fa fa-star @if($i<$post->understanding) checked @endif">
                                                    </span>
                                                    @endfor
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="comments">
                                @if(!empty($post->comments))
                                @foreach ($post->comments as $comment)
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{$comment->user->profile_image_url ?? asset('assets/images/profile.png')}}"
                                            alt="">
                                        <span class="username">
                                            <a href="#">{{$comment->user->username}}</a>
                                            {{-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> --}}
                                        </span>
                                        <span
                                            class="description">{{date('H:i A d M Y',strtotime($comment->created_at))}}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        {{$comment->comment}}
                                    </p>

                                </div>
                                @endforeach
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        @endif
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@push('scripts')
<script>
    function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
@endpush
