// Initialize socket connection
const socket = io("http://localhost:3000");

// Store chat state
let currentReceiverId = null;
let currentReceiverType = null;
let currentChatRoom = null;
let currentUserRoom = null;
let unreadMessages = [];

// Chat UI elements
const chatBox = document.getElementById("chat-box");
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");
const chatMessages = document.getElementById("chat-messages");

// User information
let currentUser = {
  id: null,
  type: null,
};

// Initialize chat
function initChat(userId, userType, chatRoomId, userRoomId) {
  console.log("Initializing chat with:", {
    userId,
    userType,
    chatRoomId,
    userRoomId,
  });

  currentUser.id = userId;
  currentUser.type = userType;
  currentChatRoom = chatRoomId;
  currentUserRoom = userRoomId;

  // Lấy thông tin người nhận từ biến global
  if (window.receiverInfo) {
    currentReceiverId = window.receiverInfo.id;
    currentReceiverType = window.receiverInfo.type;
    currentChatRoom = window.receiverInfo.chatRoom;
    currentUserRoom = window.receiverInfo.userRoom;
    console.log("Receiver info loaded:", window.receiverInfo);
  }

  // Join user's personal room
  socket.emit("join_room", currentUserRoom);
  console.log("Joined user room:", currentUserRoom);

  // Join chat room if receiver is specified
  if (chatRoomId) {
    socket.emit("join_room", chatRoomId);
    console.log("Joined chat room:", chatRoomId);
  }

  // Authenticate user
  socket.emit("authenticate", { userId, userType });
  console.log("Authenticated user:", { userId, userType });

  // Handle unread messages
  socket.on("unread_messages", (messages) => {
    console.log("Received unread messages:", messages);
    unreadMessages = messages;
    displayMessages(messages);
  });

  // Handle new messages
  socket.on("new_message", (message) => {
    console.log("Received new message:", message);
    displayMessage(message);
    // Mark message as read if it's from current chat
    if (message.sender_id === currentReceiverId) {
      socket.emit("mark_as_read", message.id);
    }
  });

  // Handle sent messages
  socket.on("message_sent", (message) => {
    console.log("Message sent successfully:", message);
    displayMessage(message);
  });

  // Set up send button
  if (sendButton) {
    sendButton.addEventListener("click", sendMessage);
  }

  // Set up enter key for message input
  if (messageInput) {
    messageInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        sendMessage();
      }
    });
  }
}

// Send message function
function sendMessage() {
  const message = messageInput.value.trim();
  console.log("Sending message:", message);

  if (!currentReceiverId || !currentReceiverType) {
    console.error("Cannot send message: Missing receiver information");
    alert("Vui lòng chọn người nhận tin nhắn");
    return;
  }

  if (message) {
    const messageData = {
      receiverId: currentReceiverId,
      receiverType: currentReceiverType,
      message: message,
      senderType: currentUser.type,
      chatRoom: currentChatRoom,
      userRoom: currentUserRoom,
    };
    console.log("Emitting private_message with data:", messageData);
    socket.emit("private_message", messageData);
    messageInput.value = "";
  } else {
    console.log("Cannot send message: Empty message");
  }
}

// Display a single message
function displayMessage(message) {
  console.log("Displaying message:", message);

  const messageElement = document.createElement("div");
  messageElement.className = `message ${
    message.sender_type === currentUser.type ? "sent" : "received"
  }`;

  // Create message content
  const messageContent = document.createElement("div");
  messageContent.className = "message-content";
  messageContent.textContent = message.message;

  // Create message time
  const messageTime = document.createElement("div");
  messageTime.className = "message-time";
  const time = new Date(message.created_at);
  messageTime.textContent = time.toLocaleTimeString();

  // Add content and time to message
  messageElement.appendChild(messageContent);
  messageElement.appendChild(messageTime);

  // Add message to chat
  chatMessages.appendChild(messageElement);
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Display multiple messages
function displayMessages(messages) {
  console.log("Displaying multiple messages:", messages);
  chatMessages.innerHTML = "";
  messages.forEach(displayMessage);
}

// Event listeners
socket.on("connect", () => {
  console.log("Connected to chat server");
});

socket.on("disconnect", () => {
  console.log("Disconnected from chat server");
});

socket.on("error", (error) => {
  console.error("Socket error:", error);
  alert(error);
});
