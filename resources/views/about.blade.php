@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('about/header')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/teaser')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/pitch')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/uxmapping')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/product')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/promotional')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/makingof')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/resource')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('about/team')
        </div>
    </div>
</div>
@endsection
