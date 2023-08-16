<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Assistant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="{{ asset('storage/css/chatbot.css') }}" rel="stylesheet">
</head>
<body>
    <div class="chat-container">
        <input class="base_url" name="base_url" value="{{ env('APP_URL') }}" type="hidden"/>
        <div class="chat-header">
            <h1>Merchant Assistant</h1>
        </div>
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will be displayed here -->
        </div>
        <div class="loader loader-wrap">
            <div class="dot-pulse"></div>
        </div>
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type your message...">
            <button id="sendMessageBtn">
                <?xml version="1.0" ?>
                <svg width="30" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <style type="text/css">
                        .st0{display:none;}
                        .st1{display:inline;}
                        .st2{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
                    </style>
                    <g class="st0" id="grid_system"/>
                    <g id="_icons">
                        <path d="M2.8,19.1C3.2,19.7,3.9,20,4.5,20c0.3,0,0.5,0,0.8-0.2L20.3,14c0.9-0.3,1.4-1.1,1.4-2s-0.5-1.7-1.4-2L5.3,4.2C4.4,3.8,3.4,4.1,2.8,4.9C2.2,5.6,2.2,6.7,2.8,7.5L6,12l-3.2,4.5C2.2,17.3,2.2,18.4,2.8,19.1z M4.4,17.7L7.8,13c0.1,0,0.2,0,0.2,0h6c0.6,0,1-0.4,1-1s-0.4-1-1-1H8c-0.1,0-0.2,0-0.2,0L4.4,6.3c0,0-0.1-0.1,0-0.2C4.4,6,4.5,6,4.5,6c0,0,0.1,0,0.1,0l14.9,5.8c0,0,0.1,0,0.1,0.2s-0.1,0.2-0.1,0.2L4.6,18c0,0-0.1,0.1-0.2-0.1C4.3,17.8,4.4,17.7,4.4,17.7z"/>
                    </g>
                </svg>
            </button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('storage/js/chatbot.js') }}"></script>
</body>
</html>
