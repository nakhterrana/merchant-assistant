<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT-like Chat</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.chat-container {
    max-width: 600px;
    margin: 0 auto;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.chat-header {
    background-color: #333;
    color: white;
    padding: 15px;
    text-align: center;
}

.chat-messages {
    max-height: 400px;
    overflow-y: auto;
    padding: 15px;
}

.message {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    background-color: #f0f0f0;
}

.message.sender-user {
    background-color: #e1f3fc;
}

.message.sender-assistant {
    background-color: #f3f3f3;
    text-align: right;
}

.chat-input {
    display: flex;
    align-items: center;
    background-color: #f0f0f0;
    padding: 15px;
}

#messageInput {
    flex-grow: 1;
    padding: 10px;
    border: none;
    border-radius: 5px;
}

#sendMessageBtn {
    margin-left: 10px;
    padding: 10px 15px;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#sendMessageBtn:hover {
    background-color: #555;
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
            <button id="sendMessageBtn">Send</button>
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
        // Simulate a delay before responding
        var params = {
            query: userMessage,
        };
        
        $.ajax({
            url: 'http://localhost/merchant-assistant/public/api/ai/query', // Replace with your actual API URL
            type: 'GET',
            data: params,
            success: function(response) {
                // Process the response here
                const responseMessage = response.data.predictions[0].content;
                appendMessage('Assistant', responseMessage, true);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
        setTimeout(() => {
         
        }, 1000);
    }

    // Simulate sending message to server and getting a response
    function sendMessageToServer(message) {
        simulateServerResponse(message);
    }
});
</script>
</html>