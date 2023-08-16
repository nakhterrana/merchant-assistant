/**
 * Initialize the chat application when the document is ready.
 */
$(document).ready(function() {
    // Elements
    const $messageInput = $('#messageInput');
    const $sendMessageBtn = $('#sendMessageBtn');
    const $chatMessages = $('#chatMessages');

    // Typing animation variables
    let typingDelay = 50; // Adjust this to control typing speed (milliseconds)
    let currentCharIndex = 0;
    let mainmessage = '';

    /**
     * Append a new message to the chat.
     *
     * @param {string} sender - The sender of the message.
     * @param {string} message - The message content.
     * @param {boolean} isAssistant - Whether the sender is the assistant.
     */
    function appendMessage(sender, message, isAssistant) {
        const messageClass = isAssistant ? 'sender-assistant' : 'sender-user';
        const messageHtml = `<div class="message ${messageClass}">
                                <span class="sender">${sender}:</span>
                                <span class="message-text"></span>
                              </div>`;
        $chatMessages.append(messageHtml);
        if (messageClass == 'sender-assistant') {
            mainmessage = message;
            currentCharIndex = 0;
            typeNextChar();
        } else {
            $(".message-text:last").append(message);
        }

        // Scroll to the bottom of the chat
        $chatMessages.scrollTop($chatMessages[0].scrollHeight);
    }

    /**
     * Type the next character of the assistant's message.
     */
    function typeNextChar() {
        let container = $(".message-text:last");
        if (currentCharIndex < mainmessage.length) {
            let char = mainmessage[currentCharIndex];

            if (char === '\n') {
                container.append("<br>");
            } else {
                container.append(char);
            }
            currentCharIndex++;
            setTimeout(typeNextChar, typingDelay);
        } else {
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
        if (!$('.chat-input').hasClass('disabled')) {
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

    /**
     * Simulate sending a message to the server and getting a response.
     *
     * @param {string} message - The message to send to the server.
     */
    function sendMessageToServer(message) {
        if (!$('.chat-input').hasClass('disabled')) {
            simulateServerResponse(message);
        }
    }

    /**
     * Simulate a server response.
     *
     * @param {string} userMessage - The message sent by the user.
     */
    function simulateServerResponse(userMessage) {
        $('.loader').addClass('active');
        $('.chat-input').addClass('disabled');
        let params = {
            query: userMessage,
        };
        const base_url = $('.base_url').val();
        const url = base_url + '/api/ai/query';
        $.ajax({
            url: url, // Replace with your actual API URL
            type: 'GET',
            data: params,
            success: function(response) {
                // Process the response here
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
});
