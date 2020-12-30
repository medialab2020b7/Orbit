@extends('layouts.app')

@section('head')
    <style>
        .modal.show .modal-dialog {
            transform: translateY(-60%);
            top: 50%;
            max-width: calc(100vw / 2);
            background-color: white;
            color: black;
        }

        .modal.show .btn-primary {
            border: 1px solid black;
            color: black;
            background-color: transparent;
        }

        .modal.show .btn-secondary {
            border: 1px solid rgba(0, 0, 0, 0.3);
            color: rgba(0, 0, 0, 0.3);
            background-color: transparent;
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }

        .modal.show .btn-primary:hover {
            border: 1px solid blue;
            color: white;
            background-color: blue;
        }

        .modal-content {
            background-color: transparent;
        }

        .modal-title {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
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
            width: calc(100% / 3);
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

        .list-group-item {
            background-color: transparent;
            color: white;
            font-size: 8pt;
        }

        .form-control {
            background-color: transparent;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div id="globeArea"></div>
                @if(Auth::check())
                <!-- Button trigger modal -->
                <button id="submitStoryButton" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#submitStoryModal">
                    Tell My Story
                </button>
                @endif

                <!--Filter Dropdowns-->
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04">
                        <option selected>Choose Emotion</option>
                        @foreach($emotions as $e)
                            <option value="{{$e->id}}">{{$e->name}}</option>
                        @endforeach
                        <!-- As emocoes são carregadas da BD. Elas foram criadas hardcoded por meio do Seeder. Checar em "./database/seeds/DatabaseSeeder.php" -->
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Go</button>
                    </div>
                </div>

                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04">
                        <option selected>Choose City</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">Go</button>
                    </div>
                </div>
            </div>

            <!-- Stories List -->
            <div class="col-md-2">
                <div class="list-group">
                    @foreach($histories as $h)
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h2 class="mb-1">
                                    {{ $h->emotion->name ?? 'emotion_not_defined' }}
                                </h2>
                                <small>{{ $h->history_date }}</small>
                            </div>
                            <p class="mb-1">{{ $h->description }}</p>
                            <small>{{ $h->user->name }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Modal -->
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
                                <select required name="emotion_id" class="form-control" id="emotion_id">
                                <option selected>Choose Emotion</option>
                                @foreach($emotions as $e)
                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputState">
                                        <input required name="history_date" id="history_date" class="form-control" type="text"
                                               placeholder="Date">
                                    </label>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">
                                            <input required name="country" id="country" class="form-control" type="text"
                                                   placeholder="Country">
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">
                                            <input required name="city" id="city" class="form-control" type="text"
                                                   placeholder="City">
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
    @endif

@endsection

@section('body')
<!-- Gio.js -->
<script src="{{ asset('js/giojs/three.min.js')}}"></script>
<script src="{{ asset('js/giojs/gio.min.js')}}"></script>
<script src="{{ asset('js/giojs/sample-data.js')}}"></script>
<script src="{{ asset('js/giojs/main.js')}}" defer></script>
<script src="{{ asset('js/history/main.js')}}" defer></script>
@endsection
