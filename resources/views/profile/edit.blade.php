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
                    <div class="form-group">
                        Name
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="form-name">
                    </div>
                    <div class="form-group">
                        Country
                        <select name="country_id" class="custom-select" id="form-country_id">
                            @if(is_null($city_id))
                                <option selected>Choose Country</option>
                            @endif
                            @foreach($countries as $c)
                                @if($country_id == $c->id)
                                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                @else
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        City
                        @if(is_null($city_id))
                            <select name="city_id" class="custom-select" id="form-city_id" disabled>
                        @else
                            <select name="city_id" class="custom-select" id="form-city_id">
                        @endif
                            @if(is_null($city_id))
                                <option selected>Choose City</option>
                            @endif
                            @foreach($cities as $c)
                                @if($city_id == $c->id)
                                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                @else
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Description
                        <textarea name="description" class="form-control" id="form-description">{{ $user->description }}</textarea>
                    </div>
                    <div class="form-group">
                        Avatar
                        <input type="file" name="avatar" class="form-control" value="{{ $user->avatar }}" id="form-avatar">
                    </div>
                    <div class="form-group">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" id="form-submit">
                                Update
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
<script src="{{ asset('js/profile/edit.js')}}" defer></script>
@endsection
