@extends('layouts.app')

@section('head')
    <!-- Gio.js -->
    <script src="{{ asset('js/giojs/three.min.js')}}"></script>
    <script src="{{ asset('js/giojs/gio.min.js')}}"></script>
    <script src="{{ asset('js/giojs/sample-data.js')}}"></script>
@endsection

@section('body')
    <script src="{{ asset('js/history/main.js')}}" defer></script>
    <script src="{{ asset('js/giojs/main.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div id="globeArea"></div>
                <!-- Button trigger modal -->
                <button id="submitStoryButton" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#submitStoryModal">
                    Tell My Story
                </button>

                <!-- Modal -->
                <div class="modal fade" id="submitStoryModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Share your story!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <input id="user_id" type="hidden" name="user" value="{{ Auth::user()->id }}">
                                    <input id="active" type="hidden" name="user" value="1">
                                    <div class="form-group">
                                        <label for="description">Write your story here</label>
                                        <textarea name="description" class="form-control" id="description"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select name="emotion_id" class="form-control" id="emotion_id">
                                            <option value="0">Emotion</option>
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputState">
                                                <input name="history_date" id="history_date" class="form-control" type="text" placeholder="Date">
                                            </label>
                                        </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputState">
                                                <input name="country" id="country" class="form-control" type="text"
                                                       placeholder="Country">
                                            </label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">
                                                <input name="city" id="city" class="form-control" type="text" placeholder="City">
                                            </label>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btn-story">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
