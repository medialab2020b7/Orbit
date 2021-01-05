@extends('layouts.app')

@section('head')
    <style>
        .avatar img {
            width: 50%;
        }

        .list-group {
            flex-direction: row;
        }

        [class^="list-group-item"] {
            background-color: transparent;
            border: 1px solid white;
            color: white;
        }

        .list-group-item + .list-group-item {
            border-top-width: 1px;
        }

        .jumbotron {
            padding: 0;
            text-align: center;
        }

        h2 {
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: blue;
            color: transparent;
        }

        h5 {
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: red;
            color: transparent;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('about/header')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/teaser')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/pitch')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/uxmapping')
        </div>
    </div>
    <!--div class="row justify-content-center">
        <div class="col-md-10">
            @-include('about/product')
        </div>
    </div-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/promotional')
        </div>
    </div>
    <!--div class="row justify-content-center">
        <div class="col-md-10">
            @--include('about/makingof')
        </div>
    </div-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/resource')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('about/team')
        </div>
    </div>
</div>
@endsection

@section('body')
<script src="{{ asset('js/about/main.js')}}" defer></script>
@endsection
