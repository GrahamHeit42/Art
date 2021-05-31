@extends('admin.layouts.app')

@push('styles')
<style>
</style>
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Post Details</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">

                                <div class="text-center">
                                    <img class="profile-user-img img-fluid" src="{{ asset($post->cover_image) }}"
                                        alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">{{$post->title}}</h3>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Description</b>
                                        <a class="float-right">{{$post->description}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Drawn By</b>
                                        <a class="float-right">{{$post->drawnBy->username ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Commisioned By</b>
                                        <a class="float-right">{{$post->commisionedBy->username ?? ''}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Subject</b>
                                        <a class="float-right">{{$post->subject->title}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Medium</b>
                                        <a class="float-right">{{$post->medium->title}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Keywords</b>
                                        <a class="float-right">{{$post->keywords}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <a class="float-right">{{$post->status_text}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Maturity Rating</b>
                                        <a class="float-right">{{$post->maturity_rating_text}}</a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">

                            <div class="card-body">
                                <strong><i class="fas fa-envelope mr-1"></i> Price</strong>
                                <p class="text-muted">{{$post->price}}</p>
                                <hr>

                                <strong><i class="fas fa-lock-open mr-1"></i> Speed</strong>
                                <p class="text-muted">{{$post->speed}}</p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Quality</strong>
                                <p class="text-muted">{{$post->quality}}</p>
                                <hr>

                                <strong><i class="fas fa-info-circle mr-1"></i> Communication</strong>
                                <p class="text-muted">{{$post->communication}}</p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Transaction</strong>
                                <p class="text-muted">{{$post->transaction}}</p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Concept</strong>
                                <p class="text-muted">{{$post->concept}}</p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Understanding</strong>
                                <p class="text-muted">{{$post->understanding}}</p>
                                <hr>

                                <strong><i class="fas fa-registered mr-1"></i> Want to work again with them?</strong>
                                <p class="text-muted">{{$post->want_work_again}}</p>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection
