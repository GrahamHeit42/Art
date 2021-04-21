@extends('admin.layouts.sidebar')
@section('title','Show Post')
@section('head-part')
<link href="{{asset('css/rating.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Show Post Details</h3>
                </div>
            </div>
            <div class="card-body m-auto" style="background-color: white;">
                <div class="row">
                    <div class="form-group row col-md-12">
                        <img src="{{$post->image}}" width="100" height="100" class="m-auto" />
                    </div>
                    <div class=" form-group row col-md-6">
                        <label for="" class="col-sm-5 col-form-label">User Name</label>
                        <div class="col-sm-7">
                            <label for="" class="col-sm-12 col-form-label fw-normal">{{$post->userDetails->first_name}}</label>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="" class="col-sm-5 col-form-label">Title</label>
                        <div class="col-sm-7">
                            <label for="" class="col-sm-12 col-form-label fw-normal">
                                {{$post->title}}</label>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="" class="col-sm-5 col-form-label">Commisioned By</label>
                        <div class="col-sm-7">
                            <label for="" class="col-sm-12 col-form-label fw-normal">
                                {{$post->name}}</label>
                        </div>
                    </div>
                    <div class="form-group row col-md-6">
                        <label for="" class="col-sm-5 col-form-label">Status</label>
                        <div class="col-sm-7">
                            <label for="" class="col-sm-12 col-form-label fw-normal">
                                @if($post->status == 0) Inactive @endif
                                @if($post->status == 1) Active @endif
                                @if($post->status == 2) Delete @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-group row col-md-12">
                        <label for="" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <label for="" class="col-sm-12 col-form-label fw-normal">
                                {{$post->description}}</label>
                        </div>
                    </div>
                    @if(isset($post->transaction) && !empty($post->transaction))
                    <div class="form-group row col-md-6">
                        <label for="transaction" class="col-sm-4 col-form-label">Transaction</label>
                        <div class="col-sm-8">
                            <input type="hidden" value="{{$post->transaction}}" id="getTransaction" />
                            <div id="full-stars-example-two">
                                <div class="rating-group">
                                    <input disabled checked class="rating__input rating__input--none" name="transaction" id="transaction-none" value="0" type="radio">
                                    <label aria-label="1 star" class="rating__label" for="transaction-1">
                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                    </label>
                                    <input class="rating__input" name="transaction" id="transaction-1" value="1" type="radio">
                                    <label aria-label="2 stars" class="rating__label" for="transaction-2">
                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                    </label>
                                    <input class="rating__input" name="transaction" id="transaction-2" value="2" type="radio">
                                    <label aria-label="3 stars" class="rating__label" for="transaction-3">
                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                    </label>
                                    <input class="rating__input" name="transaction" id="transaction-3" value="3" type="radio">
                                    <label aria-label="4 stars" class="rating__label" for="transaction-4">
                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                    </label>
                                    <input class="rating__input" name="transaction" id="transaction-4" value="4" type="radio">
                                    <label aria-label="5 stars" class="rating__label" for="transaction-5">
                                        <i class="rating__icon rating__icon--star fa fa-star"></i>
                                    </label>
                                    <input class="rating__input" name="transaction" id="transaction-5" value="5" type="radio">
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->speed) && !empty($post->speed))
                        <div class="form-group row col-md-6">
                            <label for="speed" class="col-sm-4 col-form-label">Speed</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->speed}}" id="getSpeed" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="speed" id="speed-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="speed-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="speed-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="speed-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="speed-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="speed-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="speed" id="speed-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->communication) && !empty($post->communication))
                        <div class="form-group row col-md-6">
                            <label for="communication" class="col-sm-4 col-form-label">Communication</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->communication}}" id="getCommunication" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="communication" id="communication-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="communication-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="communication-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="communication-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="communication-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="communication-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="communication" id="communication-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->prepertion) && !empty($post->prepertion))
                        <div class="form-group row col-md-6">
                            <label for="prepertion" class="col-sm-4 col-form-label">Prepertion</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->prepertion}}" id="getPrepertion" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="prepertion" id="prepertion-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="prepertion-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="prepertion" id="prepertion-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="prepertion-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="prepertion" id="prepertion-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="prepertion-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="prepertion" id="prepertion-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="prepertion-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="prepertion" id="prepertion-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="prepertion-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="prepertion" id="prepertion-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->concept) && !empty($post->concept))
                        <div class="form-group row col-md-6">
                            <label for="concept" class="col-sm-4 col-form-label">Concept</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->concept}}" id="getConcept" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="concept" id="concept-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="concept-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="concept-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="concept-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="concept-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="concept-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="concept" id="concept-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->price) && !empty($post->price))
                        <div class="form-group row col-md-6">
                            <label for="price" class="col-sm-4 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->price}}" id="getPrice" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="price" id="price-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="price-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="price" id="price-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="price-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="price" id="price-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="price-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="price" id="price-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="price-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="price" id="price-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="price-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="price" id="price-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->quality) && !empty($post->quality))
                        <div class="form-group row col-md-6">
                            <label for="quality" class="col-sm-4 col-form-label">Quality</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->quality}}" id="getQuality" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="quality" id="quality-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="quality-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="quality" id="quality-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="quality-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="quality" id="quality-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="quality-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="quality" id="quality-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="quality-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="quality" id="quality-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="quality-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="quality" id="quality-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(isset($post->professonalism) && !empty($post->professonalism))
                        <div class="form-group row col-md-6">
                            <label for="professonalism" class="col-sm-4 col-form-label">Professonalism</label>
                            <div class="col-sm-8">
                                <input type="hidden" value="{{$post->professonalism}}" id="getProfessonalism" />
                                <div id="full-stars-example-two">
                                    <div class="rating-group">
                                        <input disabled checked class="rating__input rating__input--none" name="professonalism" id="professonalism-none" value="0" type="radio">
                                        <label aria-label="1 star" class="rating__label" for="professonalism-1">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="professonalism" id="professonalism-1" value="1" type="radio">
                                        <label aria-label="2 stars" class="rating__label" for="professonalism-2">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="professonalism" id="professonalism-2" value="2" type="radio">
                                        <label aria-label="3 stars" class="rating__label" for="professonalism-3">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="professonalism" id="professonalism-3" value="3" type="radio">
                                        <label aria-label="4 stars" class="rating__label" for="professonalism-4">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="professonalism" id="professonalism-4" value="4" type="radio">
                                        <label aria-label="5 stars" class="rating__label" for="professonalism-5">
                                            <i class="rating__icon rating__icon--star fa fa-star"></i>
                                        </label>
                                        <input class="rating__input" name="professonalism" id="professonalism-5" value="5" type="radio">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
            <div class="card-footer col-md-12">
                <a href="{{url('posts')}}"><input type="button" value="Back" class="btn btn-info float" /></a>
            </div>
        </div>
    </div>
    @endsection
    @section('page-script')
    <script>
        $(document).ready(function() {
            var transaction_id = $("#getTransaction").val();
            if (transaction_id !== "") {
                $("#transaction-" + transaction_id).prop('checked', true);
            }
            var speed_id = $("#getSpeed").val();
            if (speed_id !== "") {
                $("#speed-" + speed_id).prop('checked', true);
            }
            var communication_id = $("#getCommunication").val();
            if (communication_id !== "") {
                $("#communication-" + communication_id).prop('checked', true);
            }
            var concept_id = $("#getConcept").val();
            if (concept_id !== "") {
                $("#concept-" + concept_id).prop('checked', true);
            }
            var price_id = $("#getPrice").val();
            if (price_id !== "") {
                $("#price-" + price_id).prop('checked', true);
            }
            var quality_id = $("#getQuality").val();
            if (quality_id !== "") {
                $("#quality-" + quality_id).prop('checked', true);
            }
            var professonalism_id = $("#getProfessonalism").val();
            if (professonalism_id !== "") {
                $("#professonalism-" + professonalism_id).prop('checked', true);
            }
        });
    </script>
    @if(session()->has('success'))
    <script type="text/javascript">
        toastr.success('<?php echo session()->get('success'); ?>')
    </script>
    @endif
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
        toastr.error('{{$error}}')
    </script>
    @endforeach
    @endif
    @endsection