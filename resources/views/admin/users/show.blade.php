@extends('admin.layouts.app')

@section('content')
    @php
        dump($user->toArray())
    @endphp
@endsection
