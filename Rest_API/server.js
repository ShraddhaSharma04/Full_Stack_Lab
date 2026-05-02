const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();

// Middleware
app.use(express.json());
app.use(cors());

// MongoDB connection
mongoose
  .connect("mongodb://127.0.0.1:27017/simple_user_db")
  .then(() => {
    console.log("MongoDB connected successfully");
  })
  .catch((error) => {
    console.log("MongoDB connection error:", error);
  });

// Mongoose Schema
const userSchema = new mongoose.Schema({
  name: {
    type: String,
    required: true
  },
  email: {
    type: String,
    required: true
  },
  age: {
    type: Number,
    required: true
  }
});

// Mongoose Model
const User = mongoose.model("User", userSchema);

// Home route
app.get("/", (req, res) => {
  res.send("Simple REST API is running");
});

// GET /users - Fetch all users
app.get("/users", async (req, res) => {
  try {
    const users = await User.find();
    res.json(users);
  } catch (error) {
    res.status(500).json({ message: "Error fetching users" });
  }
});

// POST /users - Add new user
app.post("/users", async (req, res) => {
  try {
    const { name, email, age } = req.body;

    const newUser = new User({
      name: name,
      email: email,
      age: age
    });

    await newUser.save();

    res.status(201).json({
      message: "User added successfully",
      user: newUser
    });
  } catch (error) {
    res.status(500).json({ message: "Error adding user" });
  }
});

// Server start
app.listen(5000, () => {
  console.log("Server running on http://localhost:5000");
});