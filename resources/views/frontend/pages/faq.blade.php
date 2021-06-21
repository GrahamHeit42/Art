@extends('frontend.layouts.app')
@section('content')
        <div class="faq">
            <div class="container" style="padding-top: 5%;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="faq-info">
                            <div class="col-md-12">
                                <h2>
                                    <strong>{{ $page->title }}</strong>
                                </h2>
                                <div class="mt-4 ">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
