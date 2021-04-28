@extends('frontend.layouts.app')

@section('content')
    <div class="gallery">
        <div class="gallery-tab">
            <div class="container">
                <div class="row no-spacing">
                    <div class="col-lg-12 col-md-12 no-spacing">
                        <div class="tab-button nav" id="nav-tab" role="tablist">
                            <a class="btn gallery-btn-green active" id="nav-commissions-tab" data-toggle="tab"
                               href="#nav-commissions" role="tab" aria-controls="nav-commissions"
                               aria-selected="true">Commissions
                            </a>
                            <a class="btn gallery-btn-dark-yellow" id="nav-lllustration-tab" data-toggle="tab"
                               href="#nav-lllustration" role="tab" aria-controls="nav-lllustration"
                               aria-selected="false">lllustration
                            </a>
                            <a class="btn gallery-btn-yellow" id="nav-2d-tab" data-toggle="tab" href="#nav-2d"
                               role="tab" aria-controls="nav-2d" aria-selected="false">2D
                            </a>
                            <a class="btn gallery-btn-green" id="nav-3d-tab" data-toggle="tab" href="#nav-3d"
                               role="tab" aria-controls="nav-3d" aria-selected="false">3D
                            </a>
                            <a href="" class="btn gallery-btn-dark-yellow">----</a>
                            <a href="" class="btn gallery-btn-yellow">----</a>
                            <a href="" class="btn gallery-btn-green">----</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-btn nav" id="nav-tab" role="tablist">
            <a class="btn gallery-btn-green" id="nav-filter-latest-tab" data-toggle="tab"
               href="#nav-filter-latest" role="tab" aria-controls="nav-filter-latest" aria-selected="false">
                Latest
            </a>
            <a class="btn gallery-btn-dark-yellow" id="filter-popular-tab" data-toggle="tab"
               href="#nav-filter-popular" role="tab" aria-controls="nav-filter-popular" aria-selected="false">
                Popular
            </a>
            <a href="#" class="btn gallery-btn-yellow">----</a>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="post tab-pane fade show active" id="nav-commissions" role="tabpanel"
                 aria-labelledby="nav-commissions-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-1.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-2.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-3.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-4.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-5.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-6.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-7.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-8.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-9.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-10.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-11.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-12.png') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-13.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-14.png') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-15.png') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-16.png') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-17.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-18.png') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-19.png') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-lllustration" role="tabpanel"
                 aria-labelledby="nav-lllustration-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-20.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-21.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-22.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-23.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-24.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-25.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-26.png') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-27.png') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-28.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-29.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-30.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-31.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-32.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-33.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-34.jpg') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-35.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-36.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-37.jpg') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-38.jpg') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-2d" role="tabpanel" aria-labelledby="nav-2d-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-39.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-40.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-41.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-42.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-43.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-44.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-45.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-46.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-47.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-48.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-49.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-50.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-51.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-52.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-53.jpg') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-54.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-55.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-3d" role="tabpanel" aria-labelledby="nav-3d-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-58.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-59.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-60.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-61.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-62.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-63.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-64.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-65.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-66.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-67.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-68.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-69.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-1.png') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-2.png') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-3.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-4.png') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-5.png') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-filter-latest" role="tabpanel"
                 aria-labelledby="nav-filter-latest-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-58.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-59.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-60.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-61.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-62.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-63.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-64.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-65.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-66.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-67.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-68.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-69.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-1.png') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-2.png') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-3.png') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-4.png') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-5.png') }}" />
                    </a>
                </div>
            </div>
            <div class="post tab-pane fade" id="nav-filter-popular" role="tabpanel"
                 aria-labelledby="nav-filter-popular-tab">
                <div class="page-type">
                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-39.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-40.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-41.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-42.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-43.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-44.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-45.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-46.jpg') }}" />
                    </a>

                    <a href="#" class="vertical">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-47.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-48.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-49.jpg') }}" />
                    </a>

                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-50.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-51.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-52.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-53.jpg') }}" />
                    </a>

                    <a href="#" class="big">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-54.jpg') }}" />
                    </a>

                    <a href="#">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-55.jpg') }}" />
                    </a>

                    <a href="#" class="horizontal">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-56.jpg') }}" />
                    </a>
                    <a href="#" class="small">
                        <img class="animate__animated animate__zoomIn"
                             src="{{ asset('assets/images/gallery/post-57.jpg') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
