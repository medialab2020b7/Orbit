@extends('layouts.app')

@section('head')
<style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat</div>

                <div class="panel-body">
                  <div class="form-group">
                    <select class="form-control" id="selectUser">
                      <option value="">Select an User</option>
                      @foreach($users as $user)
                        @if($user->id != Auth::user()->id)
                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <ul class="chat">
                    <li class="left clearfix" id="chat-messages">
                      @include('chat.message-template')
                    </li>
                  </ul>
                </div>
                <div class="panel-footer">
                  <div class="input-group" id="chat-form">
                      <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here...">
                      <input id="user-input" type="hidden" name="user" value="{{ Auth::user()->id }}">

                      <span class="input-group-btn">
                          <button class="btn btn-primary btn-sm" id="btn-chat">
                              Send
                          </button>
                      </span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
  <script src="{{ asset('js/chat/main.js')}}" defer></script>
@endsection