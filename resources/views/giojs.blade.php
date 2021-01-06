@extends('layouts.app')

@section('head')
    <style>
        .modal.show .modal-dialog {
            transform: translateY(-60%);
            top: 50%;
            background-color: white;
            color: black;
            max-height: 70vh;
            overflow-y: scroll;
        }

        .modal.show .btn-secondary {
            border: 1px solid rgba(0, 0, 0, 0.3);
            color: rgba(0, 0, 0, 0.3);
            background-color: transparent;
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }

        .modal.show .btn-primary:hover {
            color: white;
        }

        .modal-content {
            background-color: transparent;
        }

        .modal-title {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
            font-size: 200%;
        }

        .modal.show .btn-secondary:hover {
            border: 1px solid rgba(0, 0, 0, 0.3);
            color: white;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .modal-header, .modal-footer {
            border: none;
        }

        #submitStoryButton {
            position: absolute;
            bottom: 0;
            right: 0;
        }

        #globeArea {
            width: 100%;
            height: calc(100vh / 1.4);
            background-color: transparent;
        }

        .input-group {
            background-color: transparent;
            margin-top: 10px;
        }

        .custom-select {
            background-color: transparent;
            color: white;
        }

        .custom-select option {
            color: black;
        }

        .input-group .btn-outline-secondary {
            border: 1px solid white;
            color: white;
        }

        .input-group .btn-outline-secondary:hover {
            border: 1px solid red;
            background-color: red;
            color: white;
        }

        .list-group {
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .list-group-item {
            background-color: transparent;
            color: white;
            font-size: 8pt;
        }

        .form-control {
            background-color: transparent;
            color: black;
        }

        #historias {
            height: 50%;
            border: 1px solid white;
            border-radius: 0;
        }

        .btn-primary {
            background-color: transparent;
            border: 1px solid red;
            -webkit-text-stroke-color: red;
            -webkit-text-stroke-width: 1px;
            color: transparent;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: red;
            border: 1px solid red;
            color: black;
            -webkit-text-stroke-width: 0;
        }

        .btn-primary:active {
            background-color: red;
            border: 1px solid red;
            color: black;
            -webkit-text-stroke-width: 0;
        }

        .btn-primary:focus {
            background-color: red;
            border: 1px solid red;
            color: black;
            -webkit-text-stroke-width: 0;
        }

        .custom-select:disabled {
            color: white;
            background-color: transparent;
        }

        #submitStoryButton {
            width: 60%;
            margin: 0 20%;
        }

        #clearFilters {
            margin: 10% 25%;
            width: 50%;
        }

        .isSelected {
            color: blue;
            opacity: 0;
        }

        .list-elem-bottom {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <!--Filter Dropdowns-->
                <div
                    style="text-align: center; -webkit-text-stroke-color: blue; -webkit-text-stroke-width: 1px; color: transparent">
                    <h2>FILTERS</h2>
                </div>
                <div class="input-group">
                    <select name="emotion_id" class="custom-select" id="emotion_id">
                        <option value="default" selected>All Emotions</option>
                        @foreach($emotions as $e)
                            <option value="{{$e->id}}">{{$e->name}}</option>
                    @endforeach
                    <!-- As emocoes são carregadas da BD. Elas foram criadas hardcoded por meio do Seeder. Checar em "./database/seeds/DatabaseSeeder.php" -->
                    </select>
                </div>
                <button id="clearFilters" type="button" class="btn btn-primary">
                        RESET
                </button>
            </div>
            <div class="col-md-6">
                <div id="globeArea">

                </div>
            </div>
            <!-- Stories List -->
            <div class="col-md-3">
                <div
                    style="text-align: center; -webkit-text-stroke-color: blue; -webkit-text-stroke-width: 1px; color: transparent">
                    <h2 id="list-title"></h2></div>
                <div class="list-group" id="historias">
                    <a href="#"
                       class="story list-group-item list-group-item-action flex-column align-items-start"
                       data-toggle="modal"
                       data-target="#storyDataModal" data-id="">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 story-emotion-name">

                            </h3>
                            <small class="story-date"></small>
                        </div>
                        <p class="mb-1 story-description"></p>
                        <div class="list-elem-bottom">
                            <small class="story-user"></small>
                            <small class="isSelected">FOCUS</small>
                        </div>
                    </a>
                </div>
            @if(Auth::check())
                <!-- Button trigger modal -->
                    <button id="submitStoryButton" type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#submitStoryModal">
                        TELL MY STORY
                    </button>
            @endif
            </div>


            <!-- Submit Story Modal -->
            @if(Auth::check())
                <div class="modal fade" id="submitStoryModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title" id="exampleModalLabel">Share your story!</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="user_id" type="hidden" name="user" value="{{ Auth::user()->id }}">
                                <input id="active" type="hidden" name="user" value="1">
                                <div class="form-group">
                                    <label for="description">Write your story here</label>
                                    <textarea required name="description" class="form-control" id="description"
                                              rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <select required name="emotion_id_form" class="form-control" id="emotion_id_form">
                                        <option selected>Choose Emotion</option>
                                        @foreach($emotions as $e)
                                            <option value="{{$e->id}}">{{$e->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputState">
                                            <input required name="history_date" id="history_date"
                                                   class="form-control"
                                                   type="date">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select required name="country" class="form-control" id="country">
                                        <option selected>Choose Country</option>
                                        @foreach($countries as $c)
                                            <option value="{{$c->code}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select disabled required name="city" class="form-control" id="city">
                                           </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn btn-primary" id="btn-story">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif

        <!-- Story Data Modal-->
            <div class="modal fade" id="storyDataModal" tabindex="-1" role="dialog"
                 aria-labelledby="showstory" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="showStory"></h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-description">

                            </div>
                            <div class="modal-story-user">

                            </div>
                            <div class="modal-story-date">

                            </div>
                            <div class="modal-story-sound">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                                <button type="button" class="btn btn-primary" id="btn-onmap">See Connections</button>
                                <button type="button" class="btn btn-primary" id="btn-chat">Chat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
    <!-- Gio.js -->
    <script>const soundsFolder = "{{asset('sounds')}}";</script>
    <script src="{{ asset('js/giojs/three.min.js')}}"></script>
    <script src="{{ asset('js/giojs/gio.min.js')}}"></script>
    <!-- <script src="{{ asset('js/giojs/sample-data.js')}}"></script> -->
    <script src="{{ asset('js/giojs/main.js')}}" defer></script>
    <script src="{{ asset('js/giojs/form.js')}}" defer></script>
    <script src="{{ asset('js/giojs/story.js')}}" defer></script>
@endsection
