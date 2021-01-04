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
                            src="{{ asset('storage/avatar/' . $user->avatar) }}"
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
                        <div class="col-lg-6 mb-2 pr-lg-1"><img
                                src="https://images.unsplash.com/photo-1469594292607-7bd90f8d3ba4?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 mb-2 pl-lg-1"><img
                                src="https://images.unsplash.com/photo-1493571716545-b559a19edd14?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pr-lg-1 mb-2"><img
                                src="https://images.unsplash.com/photo-1453791052107-5c843da62d97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                                alt="" class="img-fluid rounded shadow-sm"></div>
                        <div class="col-lg-6 pl-lg-1"><img
                                src="https://images.unsplash.com/photo-1475724017904-b712052c192a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80"
                                alt="" class="img-fluid rounded shadow-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
<script src="{{ asset('js/profile/main.js')}}" defer></script>
@endsection
