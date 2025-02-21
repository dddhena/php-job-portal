// Chatbot UI toggle functions
function startChatbot() {
    document.getElementById('chatbot-container').style.display = 'flex';
}

function closeChatbot() {
    document.getElementById('chatbot-container').style.display = 'none';
}

// Send a message
function sendMessage() {
    const userInput = document.getElementById('user-input');
    const message = userInput.value.trim();
    if (message) {
        addMessage(message, true); // Add user's message
        userInput.value = ''; // Clear input field
        getBotResponse(message); // Generate bot response
    }
}

// Add a message to the chat
function addMessage(content, isUser) {
    const messageArea = document.getElementById('chatbot-messages');
    const message = document.createElement('div');
    message.classList.add('chatbot-message', isUser ? 'user-message' : 'bot-message');
    message.textContent = content;
    messageArea.appendChild(message);
    messageArea.scrollTop = messageArea.scrollHeight; // Auto-scroll
}

// Simulate bot responses
function getBotResponse(message) {
    let response;
    if (message.toLowerCase().includes('employer')) {
        response = "Sure, let me connect you with one of our employers. Can you share your query or area of interest?";
    } else if (message.toLowerCase().includes('job')) {
        response = "We have multiple job openings. Please specify the position or field you’re interested in.";
    } else if (message.toLowerCase().includes('thank you')) {
        response = "You're welcome! Let us know if you need further assistance.";
    } else {
        response = "I'm not sure about that. Would you like me to escalate your query to an employer?";
    }
    addMessage(response, false);
}
