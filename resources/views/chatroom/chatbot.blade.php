<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT-like Chat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .chat-container {
            width: 50%;
            max-width: 100%;
            margin: 50px auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .chat-header {
            background-color: #fff;
            color: black;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 0.4rem;
        }

        .chat-header h1 {
            font-size: 16px;
            letter-spacing: 0.1em;
            margin: 0;
        }

        .chat-messages {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
            font-size: 11px;
            line-height: 1.2;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
        }

        .message:last-child {
            margin-bottom: 5px;
        }

        .message.sender-user {
            background-color: #f9f9f9;
            float: right;
            max-width: 80%;
            margin-left: 20%;
        }

        .message.sender-assistant {
            background-color: #ebfcfd;
            text-align: right;
            max-width: 80%;
            float: left;
            margin-right: 20%;
        }

        .chat-input {
            display: flex;
            align-items: center;
            border-top: 1px solid #f0f0f0;
            padding: 10px 15px;
        }

        #messageInput {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        #sendMessageBtn {
            margin-left: 10px;
            padding: 8px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 46px;
            width: 46px;
        }

        #sendMessageBtn svg {
            fill: #8f8888;
        }

        #sendMessageBtn:hover {
            background-color: #ebebeb;
        }

        #sendMessageBtn:hover svg {
            fill: #000000;
        }

    </style>

</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>ChatGPT-like Chat</h1>
        </div>
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will be displayed here -->
        </div>
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button id="sendMessageBtn"><?xml version="1.0" ?><svg width="30" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
	.st0{display:none;}
	.st1{display:inline;}
	.st2{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
</style><g class="st0" id="grid_system"/><g id="_icons"><path d="M2.8,19.1C3.2,19.7,3.9,20,4.5,20c0.3,0,0.5,0,0.8-0.2L20.3,14c0.9-0.3,1.4-1.1,1.4-2s-0.5-1.7-1.4-2L5.3,4.2   C4.4,3.8,3.4,4.1,2.8,4.9C2.2,5.6,2.2,6.7,2.8,7.5L6,12l-3.2,4.5C2.2,17.3,2.2,18.4,2.8,19.1z M4.4,17.7L7.8,13c0.1,0,0.2,0,0.2,0   h6c0.6,0,1-0.4,1-1s-0.4-1-1-1H8c-0.1,0-0.2,0-0.2,0L4.4,6.3c0,0-0.1-0.1,0-0.2C4.4,6,4.5,6,4.5,6c0,0,0.1,0,0.1,0l14.9,5.8   c0,0,0.1,0,0.1,0.2s-0.1,0.2-0.1,0.2L4.6,18c0,0-0.1,0.1-0.2-0.1C4.3,17.8,4.4,17.7,4.4,17.7z"/></g></svg></button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
</body>
<script>
    $(document).ready(function() {
    const $messageInput = $('#messageInput');
    const $sendMessageBtn = $('#sendMessageBtn');
    const $chatMessages = $('#chatMessages');

    // Function to append a new message to the chat
    function appendMessage(sender, message, isAssistant) {
        const messageClass = isAssistant ? 'sender-assistant' : 'sender-user';
        const messageHtml = `<div class="message ${messageClass}">
                                <span class="sender">${sender}:</span>
                                <span class="message-text">${message}</span>
                              </div>`;
        $chatMessages.append(messageHtml);
        // Scroll to the bottom of the chat
        $chatMessages.scrollTop($chatMessages[0].scrollHeight);
    }

    // Simulated mock messages
    const mockMessages = [
        { sender: 'Assistant', message: 'Hello! How can I assist you today?', isAssistant: true },
        { sender: 'User', message: 'I have a question about JavaScript.' },
        // Add more mock messages here
    ];

    // Display mock messages on page load
    mockMessages.forEach(msg => {
        appendMessage(msg.sender, msg.message, msg.isAssistant);
    });

    // Send a new message
    $sendMessageBtn.click(function() {
        const newMessage = $messageInput.val();
        if (newMessage.trim() !== '') {
            appendMessage('You', newMessage, false);
            sendMessageToServer(newMessage);
            $messageInput.val('');
        }
    });

    // Listen for Enter key press in the input field
    $messageInput.keydown(function(event) {
        if (event.key === 'Enter') {
            $sendMessageBtn.click();
        }
    });

    // Simulated response from the server
    function simulateServerResponse(userMessage) {
        var params = {
            query: userMessage,
        };
        
        $.ajax({
            url: 'http://localhost/merchant-assistant/public/api/ai/query', // Replace with your actual API URL
            type: 'GET',
            data: params,
            success: function(response) {
                // Process the response here
                console.log(response.data.response);
                const responseMessage = response.data.response;
                appendMessage('Assistant', responseMessage, true);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
// Simulate a delay before responding
// setTimeout(() => {
//             const responseMessage = `I'm a ChatGPT-like assistant. You said: "${userMessage}"`;
//             appendMessage('Assistant', responseMessage, true);
//         }, 1000);

    }

    // Simulate sending message to server and getting a response
    function sendMessageToServer(message) {
        simulateServerResponse(message);
    }
});
</script>
</html>