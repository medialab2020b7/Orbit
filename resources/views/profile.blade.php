@extends('layouts.app')

@section('head')
    <style>
        main {
            overflow-x: hidden;
        }

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

        h1 {
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: red;
            color: transparent;
        }

        h2 {
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: blue;
            color: transparent;
        }

        h3 {
            font-family: "Monument Extended", "Helvetica LT Ext", sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto">
            <!-- Profile widget -->
            <div class="shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                    <div class="profile mr-3">
                        <img
                            src="{{ asset('img/avatar/' . $user->avatar) }}"
                            alt="..." width="130" class="rounded mb-2 img-thumbnail"/>
                        <a href="{{route('profile.edit')}}" class="btn btn-outline-dark btn-sm btn-block">
                        Edit  profile
                        </a>
                    </div>
                        <div class="media-body mb-5 text-white">
                            <h1 class="mt-0 mb-0">{{ $user->name }}</h1>
                            <p class="small mb-4"><i class="fas fa-map-marker-alt mr-2"></i>{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end text-center">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <h5 class="font-weight-bold mb-0 d-block">{{ $histories->count() }}</h5><small class="text-muted"> <i
                                        class="fas fa-image mr-1"></i>Stories</small>
                            </li>
                            <li class="list-inline-item">
                                <h5 class="font-weight-bold mb-0 d-block">{{ $connections }}</h5><small class="text-muted"> <i
                                        class="fas fa-user mr-1"></i>Connections</small>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="px-4">
                    <h2 class="mb-0">LOCATION</h2>
                    <div class="p-4 rounded shadow-sm">
                        <p>Country: {{ $country }}</p>
                        <p>City: {{ $city }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <h2 class="mb-0">ABOUT</h2>
                    <div class="p-4 rounded shadow-sm">
                        <p>{{ $user->description }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="mb-0">STORIES</h2><a href="#" class="btn btn-link text-muted">Show all</a>
                    </div>
                    <div class="row">
                        <!-- Stories List -->
                        <div class="col-md-12">
                            <div class="list-group" id="historias">
                                @foreach($histories as $h)
                                    <a href="#" class="story list-group-item list-group-item-action flex-column align-items-start" data-toggle="modal"
                                       data-target="#profileStoryModal" data-id={{$h->id}}>
                                        <div class="d-flex w-100 justify-content-between">
                                            <h3 class="mb-1">
                                                {{ $h->emotion->name ?? 'emotion_not_defined' }}
                                            </h3>
                                            <small>{{ $h->history_date }}</small>
                                        </div>
                                        <p class="mb-1">{{ $h->description }}</p>
                                        <small>{{ $h->user->name }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Story Data Modal-->
                <div class="modal fade" id="profileStoryModal" tabindex="-1" role="dialog"
                     aria-labelledby="showstory" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="showStory"></h3>
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
                                    <button type="button" class="btn btn-primary" id="btn-story">See Connections</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
<script src="{{ asset('js/profile/main.js')}}" defer></script>
@endsection
