@extends('layouts.app')

@section('head')
    <!-- CSS Goes Here -->
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
                    <h2 class="mb-0">Localization</h2>
                    <div class="p-4 rounded shadow-sm">
                        <p>Country: {{ $country }}</p>
                        <p>City: {{ $city }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <h2 class="mb-0">About</h2>
                    <div class="p-4 rounded shadow-sm">
                        <p>{{ $user->description }}</p>
                    </div>
                </div>
                <div class="px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="mb-0">Stories</h2><a href="#" class="btn btn-link text-muted">Show all</a>
                    </div>
                    <div class="row">
                        <!-- Stories List -->
                        <div class="col-md-12">
                            <div class="list-group" id="historias">
                                @foreach($histories as $h)
                                    <a href="#" class="story list-group-item list-group-item-action flex-column align-items-start" data-toggle="modal"
                                       data-target="#storyDataModal" data-id={{$h->id}}>
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
            </div>
        </div>
    </div>
@endsection

@section('body')
<script src="{{ asset('js/profile/main.js')}}" defer></script>
@endsection
