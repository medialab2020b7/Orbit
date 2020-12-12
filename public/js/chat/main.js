$(function() {
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

    const fetchChatMessages = () => axios.get('/push-messages',{
        params: {
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
            axios.post('/push-messages', {
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