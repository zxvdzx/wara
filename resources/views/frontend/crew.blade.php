@extends('frontend.layout.layoutcustom')

@section('title', 'Team')

@section('content')
    @include('frontend.team')
    <br>
    @include('frontend.spokesman')
    <br>
    @include('frontend.tutor')
@endsection
