@extends('layouts.app')

@section('head')
<!-- Gio.js -->
<script src="{{ asset('js/giojs/three.min.js')}}"></script>
<script src="{{ asset('js/giojs/gio.min.js')}}"></script>
<script src="{{ asset('js/giojs/sample-data.js')}}"></script>
@endsection

@section('body')
<script src="{{ asset('js/giojs/main.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Gio.js</div>

                <div class="card-body">
                    <div id="globeArea" style="width: 100%; height: 400px"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
