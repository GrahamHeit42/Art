@extends('frontend.layouts.app')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick-theme.css') }}">
@endpush

@section('content')
    <div class="gallery">
        <div class="gallery-tab">
            <div class="container">
                <div class="row no-spacing">

                    <div class="col-lg-2 m-auto">
                        <a class="btn gallery-btn-green">Commissions</a>
                    </div>
                    <div class="col-lg-10 col-md-10 no-spacing">
                        <div class="tab-button nav gallerybtn-slider" id="nav-tab" role="tablist">
                            @foreach($subjects as $key => $subject)
                                <a href="javascript:" class="btn {{ (($key) % 3) === 0 ? 'gallery-btn-dark-yellow' : ((($key) % 3) === 1 ? 'gallery-btn-yellow' : 'gallery-btn-green') }}">{{ $subject->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter">
            <div class="post-btn nav" id="nav-tab" role="tablist">
                <a class="btn gallery-btn-green" id="nav-filter-latest-tab" data-toggle="tab" href="#nav-filter-latest"
                   role="tab" aria-controls="nav-filter-latest" aria-selected="false">Latest</a>
                <a class="btn gallery-btn-dark-yellow" id="filter-popular-tab" data-toggle="tab"
                   href="#nav-filter-popular" role="tab" aria-controls="nav-filter-popular" aria-selected="false">Popular</a>
                <a class="btn gallery-btn-yellow" id="filter-trending-tab" data-toggle="tab"
                   href="#nav-filter-trending" role="tab" aria-controls="nav-filter-trending" aria-selected="false">Trending</a>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="mediums-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mediums
                </button>
                <div class="dropdown-menu mediums-dropdown" aria-labelledby="mediums-dropdown">
                    @foreach($mediums as $key => $medium)
                        <div class="form-check dropdown-item">
                            <input class="form-check-input" type="checkbox" name="filter[mediums]" id="medium-{{ $medium->id }}" value="{{ $medium->id }}">
                            <label class="form-check-label" for="medium-{{ $medium->id }}">
	                            {{ $medium->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="tab-content" id="nav-tabContent">
            {{--<div class="post tab-pane fade show active" id="nav-2d" role="tabpanel" aria-labelledby="nav-2d-tab">
                <div class="page-type">
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-39.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-40.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-41.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-42.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-43.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-44.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-45.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-46.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-47.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-48.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-49.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-50.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-51.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-52.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-53.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-54.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-55.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-3d" role="tabpanel" aria-labelledby="nav-3d-tab">
                <div class="page-type">
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-58.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-59.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-60.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-61.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-62.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-63.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-64.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-65.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-66.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-67.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-68.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-69.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-1.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-2.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-3.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-4.png') }}" />
                    </a>
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-5.png') }}" />
                    </a>
                </div>
            </div>--}}
            <div class="post tab-pane fade show active" id="nav-filter-latest" role="tabpanel"
                 aria-labelledby="nav-filter-latest-tab">
                <div class="page-type">
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-58.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-59.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-60.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-61.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-62.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-63.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-64.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-65.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-66.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-67.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-68.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-69.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-1.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-2.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-3.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-4.png') }}" />
                    </a>
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-5.png') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-filter-popular" role="tabpanel"
                 aria-labelledby="nav-filter-popular-tab">
                <div class="page-type">
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-39.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-40.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-41.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-42.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-43.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-44.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-45.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-46.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-47.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-48.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-49.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-50.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-51.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-52.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-53.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-54.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-55.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-filter-trending" role="tabpanel"
                 aria-labelledby="nav-filter-trending-tab">
                <div class="page-type">
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-20.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-21.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-22.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-23.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-24.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-25.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-26.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-27.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-28.png') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-29.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-30.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-31.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-32.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-33.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-34.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-35.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-36.jpg') }}" />
                    </a>

                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-37.jpg') }}" />
                    </a>
                    <a href="{{ url('posts/1') }}" class="vertical">
                        <img class="animate__animated animate__zoomIn" alt="Post"
                             src="{{ asset('assets/images/gallery/post-38.jpg') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/slick-slider/js/slick.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('.gallerybtn-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                arrow: true,
                prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-play' aria-hidden='true'></i></button>",
                nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-play' aria-hidden='true'></i></button>",
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: false,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
    </script>
@endpush
