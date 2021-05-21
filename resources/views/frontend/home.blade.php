@extends('frontend.layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick-theme.css') }}">
@endpush

@section('content')
<div class="gallery">
    <div class="gallery-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="tab-button nav gallerybtn-slider" id="nav-tab" role="tablist">
                        @foreach($subjects as $key => $subject)
                        {{-- <a href="javascript:" class="btn {{ (($key) % 3) === 0 ? 'gallery-btn-dark-yellow' : ((($key) % 3) === 1 ? 'gallery-btn-yellow' : 'gallery-btn-green') }}">{{ $subject->title }}</a>
                        --}}
                        <div class="item mr-3">
                            <a href="{{url('/?sid='.$subject->id)}}">
                                <div class="tabbox">
                                    <h2>{{ $subject->title }}</h2>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter">
        <div class="post nav" id="nav-tab" role="tablist">
            <a class="button btngreen" id="nav-filter-latest-tab" data-toggle="tab" href="#nav-filter-latest" role="tab" aria-controls="nav-filter-latest" aria-selected="false">Latest</a>
            <a class="button btnyellow" id="filter-popular-tab" data-toggle="tab" href="#nav-filter-popular" role="tab" aria-controls="nav-filter-popular" aria-selected="false">Popular</a>
            <a class="button btndarkyellow" id="filter-trending-tab" data-toggle="tab" href="#nav-filter-trending" role="tab" aria-controls="nav-filter-trending" aria-selected="false">Trending</a>
        </div>
        <div class="artsoption">
            <div class="commissions">

                <label for="commissionscheck">Commissions</label>
                <input class="commissions_input" type="radio" name="commissions" value="option1" id="commissionscheck" checked>
            </div>
            <div class="mediums">
                <a class="meddropdown dropdown-toggle" type="button" id="mediumsdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Mediums
                </a>
                <div class="dropdown-menu mediums-dropdown" aria-labelledby="mediumsdropdown">
                    @foreach($mediums as $key => $medium)
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" name="filter[mediums]" id="medium-{{ $medium->id }}" value="{{ $medium->id }}" onchange="filterMedium('{{ $medium->id }}');">
                        <label class="form-check-label" for="medium-{{ $medium->id }}">
                            {{ $medium->title }}
                        </label>
                    </div>
                    @endforeach
                </div>

                {{-- <a class="meddropdown dropdown-toggle" type="button" id="mediumsdropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Mediums
                </a>
                <div class="dropdown-menu mediums-dropdown" aria-labelledby="mediumsdropdown">
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" name="exampleRadios" id="mediums1" value="option1">
                        <label class="form-check-label" for="mediums1">
                            lllustration
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" name="exampleRadios" id="mediums2" value="option1">
                        <label class="form-check-label" for="mediums2">
                            2D
                        </label>
                    </div>
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" name="exampleRadios" id="mediums3" value="option1">
                        <label class="form-check-label" for="mediums3">
                            3D
                        </label>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="tab-content" id="nav-tabContent">
        <div class="post tab-pane fade show active" id="nav-filter-latest" role="tabpanel" aria-labelledby="nav-filter-latest-tab">
            <div class="page-type">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" class="vertical">
                    <img class="animate__animated animate__zoomIn" alt="Post" src="{{ asset($post->cover_image ?? $post->images->first()->image_path ?? 'assets/images/gallery/post-56.jpg') }}" />
                </a>
                @endforeach
            </div>
        </div>
        <div class="post tab-pane fade" id="nav-filter-popular" role="tabpanel" aria-labelledby="nav-filter-popular-tab">
            <div class="page-type">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" class="vertical">
                    <img class="animate__animated animate__zoomIn" alt="Post" src="{{ asset($post->images->first()->image_path ?? 'assets/images/gallery/post-56.jpg') }}" />
                </a>
                @endforeach
            </div>
        </div>
        <div class="post tab-pane fade" id="nav-filter-trending" role="tabpanel" aria-labelledby="nav-filter-trending-tab">
            <div class="page-type">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" class="vertical">
                    <img class="animate__animated animate__zoomIn" alt="Post" src="{{ asset($post->images->first()->image_path ?? 'assets/images/gallery/post-56.jpg') }}" />
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/slick-slider/js/slick.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.gallerybtn-slider').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            autoplay: false,
            arrow: true,
            prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",
            nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",
            // centerMode: true,
            variableWidth: true,
            responsive: [{
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
<script>
    function filterMedium(medium_id) {
        window.location.href = "{{url('/?mid=')}}" + medium_id;
    }
</script>
@endpush