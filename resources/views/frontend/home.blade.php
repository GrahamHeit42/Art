@extends('frontend.layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/slick-slider/css/slick-theme.css') }}">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/dot-luv/jquery-ui.css">
@endpush

@section('content')
<div class="gallery">
    <div class="gallery-tab">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <input type="hidden" name="subject_id" id="subject_id" value="{{ request()->get('sid') ?? 0 }}">
                    <div class="tab-button nav gallertab owl-carousel " id="nav-tab" role="tablist">
                        @foreach($subjects as $key => $subject)
                        <div class="item mr-3 {{ request()->get('sid') == $subject->id ? 'item-active' : '' }}">
                            <a href="javascript:" onclick="filterPosts({{ $subject->id }})">
                                <div class="tabbox" style="background-image: url('{{ $subject->image_url }}')">
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
            <a class="button btngreen" id="nav-filter-latest-tab" data-bs-toggle="tab" href="#nav-filter-latest"
                role="tab" aria-controls="nav-filter-latest" aria-selected="false">Latest</a>
            <a class="button btnyellow" id="filter-popular-tab" data-bs-toggle="tab" href="#nav-filter-popular"
                role="tab" aria-controls="nav-filter-popular" aria-selected="false">Popular</a>
            <a class="button btndarkyellow" id="filter-trending-tab" data-bs-toggle="tab" href="#nav-filter-trending"
                role="tab" aria-controls="nav-filter-trending" aria-selected="false">Trending</a>
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
<script type="text/javascript">
    function filterPosts(sid) {
        if (sid !== undefined && sid !== null && sid !== '') {
            $("#subject_id").val(sid);
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

        window.location.href = filterUrl;
    }
</script>
<script>
    $("#sortable").sortable({
    revert: true,
    stop: function(event, ui) {
        if(!ui.item.data('tag') && !ui.item.data('handle')) {
            ui.item.data('tag', true);
            // ui.item.fadeTo(400, 0.1);
        }
    }
});
$("ul, li").disableSelection();
</script>
@endpush
