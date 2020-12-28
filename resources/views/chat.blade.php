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
<script defer>
$(function() {
    const token = $("#token").val();

    const chatPlace = $("#chat-messages");
    let messageTemplate = chatPlace.find(".chat-body");

    const chatSend = $("#btn-chat");
    const chatValueMessage = $("#btn-input");
    const chatValueUser = $("#user-input");
    const chatReceiver = $("#selectUser");
    let selectedChatReceiver = chatReceiver.find(":selected");

    const addMessage = e => {
        const newMessage = messageTemplate.clone();
        const user = newMessage.find(".chat-user");
        const content = newMessage.find(".chat-content");
        user.text(e.user.name);
        content.text(e.message);
        chatPlace.append(newMessage);
        newMessage.removeClass("hidden");
    };

    const clearChatMessages = () => {
        messageTemplate = messageTemplate.clone();
        chatPlace.empty();
        chatPlace.append(messageTemplate);
    };

    const fetchChatMessages = () => axios.get('/api/messages',{
        params: {
            api_token: token,
            receiver_id: selectedChatReceiver.val()
        }
    }).then(response => {
        console.log("Loaded messages"); console.log(response); console.log(response.data);  //Testing
        let chatMessages = response.data;
        chatMessages.forEach(e => addMessage(e));
    }).catch(err => {
        console.log("ERROR Loaded messages");  //Testing
        console.log(err);
        if (err.response) console.log(err.response);
        else if (err.request) console.log(err.request);
    });

    const loadChatMessages = () => {
        fetchChatMessages();

        //Real-time
        Echo.private('chat')
        .listen('MessageSent', (e) => {
            console.log("Echo loaded"); console.log(e); //Testing

            if(chatValueUser.val() == e.message.receiver_id && selectedChatReceiver.val() == e.message.user_id){
                console.log("Echo updated");    //Testing
                addMessage({
                    user: { name: e.user.name },
                    message: e.message.message
                });
            }  
        });
    };

    chatSend.on( "click", function() {
        let message = chatValueMessage.val();
        let receiver_id = selectedChatReceiver.val();

        if(receiver_id !== "" && message !== ""){
            axios.post('/api/messages', {
                api_token: token,
                message,
                receiver_id
            }).then(response => {
                console.log("Added message"); console.log(response); console.log(response.data);    //Testing
                addMessage({
                    user: { name: response.data.user.name },
                    message: response.data.message.message
                });
                chatValueMessage.val("");
            }).catch(err => {
                console.log("ERROR Added message");
                console.log(err);
                if (err.response) console.log(err.response);
                else if (err.request) console.log(err.request);
            });
        }
    });

    chatReceiver.on('change', function() {
        selectedChatReceiver = chatReceiver.find(":selected");
        const val = selectedChatReceiver.val();
        clearChatMessages();

        if(val !== "") loadChatMessages();
    });
});  
</script>
@endsection