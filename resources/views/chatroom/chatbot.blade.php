<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Assistant</title>
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
            width: 90%;
            max-width: 100%;
            margin: 50px auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .chat-header {
            background-color: #343541;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(32,33,35,.5);
        }

        .chat-header h1 {
            font-size: 16px;
            letter-spacing: 0.1em;
            margin: 0;
            font-weight: 400;
        }

        .chat-messages {
            max-height: 400px;
            overflow-y: auto;
            font-size: 11px;
            line-height: 1.2;
            height: 100vh;
            background-color: #343541;
        }

        .message {
            padding: 13px 30px 13px 60px;
            background-color: #f0f0f0;
            box-sizing: border-box;
            color: #ffffff;
            font-size: 14px;
            line-height: 24px;
            position: relative;
        }

        .message.sender-user {
            background-color: #444654;
            width: 100%;
        }

        .message.sender-assistant {
            background-color: #343541;
            width: 100%;
        }

        .chat-input {
            display: flex;
            align-items: center;
            border-top: 1px solid #000000;
            padding: 10px 15px;
            background-color: #343541;
            box-sizing: border-box;
            width: 100%;
        }

        #messageInput {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            height: 26px;
            background-color: #343541;
            color: #ffffff;
            font-size: 16px;
        }

        /*#messageInput::placeholder {
            color: #ffffff;
        }

        #messageInput:-ms-input-placeholder {
            color: #ffffff;
        }

        #messageInput::-ms-input-placeholder {
            color: #ffffff;
        }*/

        #sendMessageBtn {
            margin-left: 10px;
            padding: 8px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            height: 46px;
            width: 46px;
            background-color: #444654;
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


        .message:before {
            content: '';
            background-size: auto;
            background-position: center;
            background-repeat: no-repeat;
            height: 34px;
            width: 34px;
            position: absolute;
            left: 15px;
            top: 8px;
        }

        .message.sender-assistant:before {
            background-image: url("{{ url('images/favicon.ico') }}");
            background-color: #444654;
             background-size: 70%;
        }

        .message.sender-user:before {
            background-image: url("{{ url('images/user.svg') }}");
            background-size: 70%;
            background-color: #343541;
        }

        .dot-pulse {
            position: relative;
            left: -9999px;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #646464;
            color: #646464;
            box-shadow: 9999px 0 0 -5px;
            animation: dot-pulse 1.5s infinite linear;
            animation-delay: 0.25s;
            margin: 0 auto;
            opacity: 0;
        }

        .loader.active .dot-pulse {
            opacity: 1;
        }

        .dot-pulse::before, .dot-pulse::after {
            content: "";
            display: inline-block;
            position: absolute;
            top: 0;
            width: 10px;
            height: 10px;
            border-radius: 5px;
            background-color: #646464;
            color: #646464;
        }
        .dot-pulse::before {
            box-shadow: 9984px 0 0 -5px;
            animation: dot-pulse-before 1.5s infinite linear;
            animation-delay: 0s;
        }
        .dot-pulse::after {
            box-shadow: 10014px 0 0 -5px;
            animation: dot-pulse-after 1.5s infinite linear;
            animation-delay: 0.5s;
        }

        .loader-wrap {
            background-color: #343541;
            padding: 10px 0;
        }

        @keyframes dot-pulse-before {
            0% {
                box-shadow: 9984px 0 0 -5px;
            }
            30% {
                box-shadow: 9984px 0 0 2px;
            }
            60%, 100% {
                box-shadow: 9984px 0 0 -5px;
            }
        }
        @keyframes dot-pulse {
            0% {
                box-shadow: 9999px 0 0 -5px;
            }
            30% {
                box-shadow: 9999px 0 0 2px;
            }
            60%, 100% {
                box-shadow: 9999px 0 0 -5px;
            }
        }
        @keyframes dot-pulse-after {
            0% {
                box-shadow: 10014px 0 0 -5px;
            }
            30% {
                box-shadow: 10014px 0 0 2px;
            }
            60%, 100% {
                box-shadow: 10014px 0 0 -5px;
            }
        }

        .disabled {
            background-color: #0a0a0a;
            color: #0a0909;
            cursor: not-allowed;
            opacity: 0.6;
            pointer-events: none;
        }

    </style>

</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h1>Merchant Assistant</h1>
        </div>
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will be displayed here -->
        </div>
        <div class="loader loader-wrap"><div class="dot-pulse"></div></div>
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

    var typingDelay = 50; // Adjust this to control typing speed (milliseconds)
    var currentCharIndex = 0;
    var mainmessage = '';

    // Function to append a new message to the chat
    function appendMessage(sender, message, isAssistant) {
        
        const messageClass = isAssistant ? 'sender-assistant' : 'sender-user';
        const messageHtml = `<div class="message ${messageClass}">
                                <span class="sender">${sender}:</span>
                                <span class="message-text"></span>
                              </div>`;
        $chatMessages.append(messageHtml);
            if(messageClass == 'sender-assistant'){
                mainmessage = message;
                currentCharIndex = 0;
                typeNextChar();
            }else{
                $(".message-text:last").append(message);   
            }
       
        // Scroll to the bottom of the chat
        $chatMessages.scrollTop($chatMessages[0].scrollHeight);
    }



    function typeNextChar() {
        let container = $(".message-text:last");    
        if (currentCharIndex < mainmessage.length) {
        var char = mainmessage[currentCharIndex];

        if (char === '\n') {
            container.append("<br>");
        } else {
            console.log(container);
            container.append(char);
        }
        currentCharIndex++;
        setTimeout(typeNextChar, typingDelay);
        }else{
            $chatMessages.scrollTop($chatMessages[0].scrollHeight);
        }
    }

    // Simulated mock messages
    const mockMessages = [
        { sender: 'Bot', message: 'Hello! How can I assist you today?', isAssistant: true },

        // Add more mock messages here
    ];

    // Display mock messages on page load
    mockMessages.forEach(msg => {
        appendMessage(msg.sender, msg.message, msg.isAssistant);
    });

    // Send a new message
    $sendMessageBtn.click(function() {
        const newMessage = $messageInput.val();
        if(!$('.chat-input').hasClass('disabled')){
            if (newMessage.trim() !== '') {
                appendMessage('You', newMessage, false);
                sendMessageToServer(newMessage);
                $messageInput.val('');
            }
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
        $('.loader').addClass('active');
        $('.chat-input').addClass('disabled');
        var params = {
            query: userMessage,
        };
        
        $.ajax({
            url: 'http://127.0.0.1:8000/api/ai/query', // Replace with your actual API URL
            type: 'GET',
            data: params,
            success: function(response) {
                // Process the response here
                console.log(response.data.response);
                const responseMessage = response.data.response;
                appendMessage('Assistant', responseMessage, true);
                $('.loader').removeClass('active');
                $('.chat-input').removeClass('disabled');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('.loader').removeClass('active');
                $('.chat-input').removeClass('disabled');
            }
        });
    }

    // Simulate sending message to server and getting a response
    function sendMessageToServer(message) {
        if(!$('.chat-input').hasClass('disabled')){
            simulateServerResponse(message);
        }
    }
});
</script>
</html>