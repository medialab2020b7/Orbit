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
            <div id="globeArea"></div>
        </div>
        <!-- Button trigger modal -->
        <button id="submitStoryButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitStoryModal">
            Tell My Story
        </button>

        <!-- Modal -->
        <div class="modal fade" id="submitStoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Share your story!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Write your story here</label>
                                <textarea name="story" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <select name="emotion" class="form-control">
                                    <option>Emotion</option>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputState">
                                    <input name="day" class="form-control" type="text" placeholder="Day">
                                    </label>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="inputState">
                                    <input name="month" class="form-control" type="text" placeholder="Month">
                                    </label>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="inputState">
                                    <input name="year" class="form-control" type="text" placeholder="Year">
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
