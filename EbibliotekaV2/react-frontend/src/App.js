// src/App.js
import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import HomePage from "./pages/HomePage";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
import BookPage from "./pages/BookPage";
import Navbar from "./components/NavBar";

function App() {
  return (
    <Router>
      {/* Navigacija je na svakoj stranici */}
      <Navbar />

      {/* Definisane rute */}
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
        <Route path="/books/:id" element={<BookPage />} />
      </Routes>
    </Router>
  );
}

export default App;
