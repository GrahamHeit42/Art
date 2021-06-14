@extends('frontend.layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick-theme.css') }}">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/dot-luv/jquery-ui.css">
@endpush

@section('content')
<div class="gallery art-page-gallery">
    <div class="gallery-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <input type="hidden" name="subject_id" id="subject_id" value="{{ request()->get('sid') ?? 0 }}">
                    <div class="tab-button nav gallertab owl-carousel " id="nav-tab" role="tablist">
                        @foreach($subjects as $key => $subject)
                        <div class="item mr-3 {{ request()->get('sid') == $subject->id ? 'item-active' : '' }}" style="background-color: {{ request()->get("sid") == $subject->id ? '#c0c416' : '' }}">
                            <a href="javascript:" onclick="filterPosts({{ $subject->id }})">
                                <div class="tabbox"
                                    style="background-image: url('{{ $subject->image_url }}');">
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
            <a class="button btngreen" id="nav-filter-latest-tab1" data-bs-toggle="tab" href="#nav-filter-latest1"
                role="tab" aria-controls="nav-filter-latest" aria-selected="false" onclick="filterPopularPosts()">Latest</a>
            <a class="button btnyellow {{request()->get('p') == 1 ? 'text-dark' : ''}}" id="filter-popular-tab"
                data-bs-toggle="tab" href="#nav-filter-popular1" role="tab" aria-controls="nav-filter-popular"
                aria-selected="false" onclick="filterPopularPosts(1)">Popular</a>
            <input type="hidden" name="popular" id="popular" value="{{request()->get('p') ?? 0}}" />
            <a class="button btndarkyellow" id="filter-trending-tab1" data-bs-toggle="tab" href="#nav-filter-trending1"
                role="tab" aria-controls="nav-filter-trending" aria-selected="false" onclick="filterPopularPosts()">Trending</a>
        </div>
        <div class="artsoption">
            <div class="commissions">

                <label for="is_commissions_posts">Commissions</label>
                <input class="commissions_input" type="checkbox" name="commissions" value="1" id="is_commissions_posts"
                    onchange="filterPosts()" {{ (request()->get('c') === 'true') ? 'checked' : '' }}>
            </div>
            <div class="mediums">
                <a class="meddropdown dropdown-toggle" type="button" id="mediumsdropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    All Mediums
                </a>
                <div class="dropdown-menu mediums-dropdown" aria-labelledby="mediumsdropdown">
                    @foreach($mediums as $key => $medium)
                    <div class="form-check dropdown-item">
                        <input class="form-check-input" type="checkbox" name="filter[mediums]"
                            id="medium-{{ $medium->id }}" value="{{ $medium->id }}" onchange="filterPosts()"
                            {{ !empty(request()->get('mid')) && in_array($medium->id, explode(',', request()->get('mid'))) ? 'checked' : '' }} />
                        <label class="form-check-label" for="medium-{{ $medium->id }}">
                            {{ $medium->title }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content" id="nav-tabContent">
        <div class="post tab-pane fade show active" id="nav-filter-latest" role="tabpanel"
            aria-labelledby="nav-filter-latest-tab">
            <div class="atrtspostimg row no-spacing" id="sortable">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}"
                    class="col-lg-2 col-md-2 col-sm-4 col-xs-6 no-spacing dragable">
                    <img class="animate__animated animate__zoomIn" alt="Post"
                        src="{{ asset($post->cover_image ?? ($post->images->first()->image_path ?? 'assets/images/noimage.jpg')) }}" />
                </a>
                @endforeach
            </div>
        </div>
        <div class="post tab-pane fade" id="nav-filter-popular" role="tabpanel"
            aria-labelledby="nav-filter-popular-tab">
            <div class="atrtspostimg row no-spacing">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 no-spacing">
                    <img class="animate__animated animate__zoomIn" alt="Post"
                        src="{{ asset($post->cover_image ?? ($post->images->first()->image_path ?? 'assets/images/noimage.jpg')) }}" />
                </a>
                @endforeach
            </div>
        </div>
        <div class="post tab-pane fade" id="nav-filter-trending" role="tabpanel"
            aria-labelledby="nav-filter-trending-tab">
            <div class="atrtspostimg row no-spacing">
                @foreach($posts as $post)
                <a href="{{ url('posts/' . $post->id) }}" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 no-spacing">
                    <img class="animate__animated animate__zoomIn" alt="Post"
                        src="{{ asset($post->cover_image ?? ($post->images->first()->image_path ?? 'assets/images/noimage.jpg')) }}" />
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section("footer")
<footer id="footer">
    <div class="row">
        <div class="col-lg-8">
            <div class="usefull-link">
                <ul>
                    <li>
                        <a href="{{ url('terms-and-conditions') }}">Terms and conditions</a>
                    </li>
                    <li>
                        <a href="{{ url('help-and-faqs') }}">Help & FAQ</a>
                    </li>
                    <li>
                        <a href="{{ url('contact-us') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="realeyze">
                <p>©2021
                    <a href="#">Realeyze</a>
                    | Version {{ config('constants.app.version') }}
                </p>
            </div>
        </div>
    </div>
</footer>
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
                        slidesToScroll: 2,
                        infinite: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: false,
                    }
                }
            ]
        });

    });
</script>
<script type="text/javascript">
    function filterPopularPosts(is_popular){
        if($("#popular").val() == 0 && parseInt(is_popular) === 1){
            $("#popular").val("1");
            filterPosts();
        }
        else{
            $("#popular").val("0");
            filterPosts();
        }
    }

    function filterPosts(sid) {

        if (sid !== undefined && sid !== null && sid !== '') {
            if($("#subject_id").val() == sid){
                $("#subject_id").val(0);
            }else{
                $("#subject_id").val(sid);
            }
        }

        var search = $("#search").val();
        var subjectId = $("#subject_id").val();

        var mediumIds = [];
        $("input[name='filter[mediums]']:checked").each(function() {
            mediumIds.push(parseInt($(this).val()));
        });
        var isCommissionsPosts = $("#is_commissions_posts").prop('checked');

        var filterUrl = '{{ url("/") }}?';
        var singleFilter = true;
        var popular = $("#popular").val();

        if (search.toString().length > 0) {
            singleFilter = false;
            filterUrl += 'q=' + search;
        }
        if (parseInt(subjectId) > 0) {
            filterUrl += (singleFilter === false ? '&' : '') + 'sid=' + parseInt(subjectId);
            singleFilter = false;
        }
        if (mediumIds.length > 0) {
            filterUrl += (singleFilter === false ? '&' : '') + 'mid=' + mediumIds;
            singleFilter = false;
        }
        if (isCommissionsPosts === true) {
            filterUrl += (singleFilter === false ? '&' : '') + 'c=' + isCommissionsPosts;
            singleFilter = false;
        }
        if (parseInt(popular) == 1) {
            filterUrl += (singleFilter === false ? '&' : '') + 'p=' + parseInt(popular);
            singleFilter = false;
        }

        window.location.href = filterUrl;
    }
</script>
@endpush
