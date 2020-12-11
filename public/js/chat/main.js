$(function() {
    const chatPlace = $("#chat-messages");
    const messageTemplate = chatPlace.find(".chat-body");

    const chatSend = $("#btn-chat");
    const chatValueMessage = $("#btn-input");
    const chatValueUser = $("#user-input");

    const addMessage = e => {
        const newMessage = messageTemplate.clone();
        const user = newMessage.find(".chat-user");
        const content = newMessage.find(".chat-content");
        user.text(e.user.name);
        content.text(e.message);
        chatPlace.append(newMessage);
        newMessage.removeClass("hidden");
    };

    const fetchChatMessages = () => axios.get('/push-messages').then(response => {
        let chatMessages = response.data;
        chatMessages.forEach(e => addMessage(e));
    });

    const loadChatMessages = () => {
        fetchChatMessages();

        Echo.private('chat')
        .listen('MessageSent', (e) => {
            console.log(e)
            addMessage({
                user: {
                    name: e.user.name
                },
                message: e.message.message
            });
        });
    };

    chatSend.on( "click", function() {
        let message = chatValueMessage.val();

        axios.post('/push-messages', {message}).then(response => {
            addMessage({
                user: {
                    name: chatValueUser.val()
                },
                message
            });
        });
    });

    loadChatMessages();
});