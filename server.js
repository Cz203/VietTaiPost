const express = require("express");
const app = express();
const http = require("http").createServer(app);
const io = require("socket.io")(http, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"],
  },
});
const cors = require("cors");

// Import socket modules
const initializeChat = require("./socket/chatbox");
const initializeTracking = require("./socket/tracking");

app.use(cors());

// Initialize chat functionality
initializeChat(io);

// Initialize tracking functionality
initializeTracking();

const PORT = process.env.PORT || 3000;
http.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
