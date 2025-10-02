// src/App.js
import React, { useEffect, useState } from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import HomePage from "./pages/HomePage";
import LoginPage from "./pages/LoginPage";
import RegisterPage from "./pages/RegisterPage";
import BookPage from "./pages/BookPage";
import Navbar from "./components/NavBar";
import ContactPage from "./pages/ContactPage";
import SubscriptionPage from "./pages/SubscriptionPage";
import api, { getUser, logoutUser } from "./services/api"; // koristiš getUser() iz api

function App() {
    const [user, setUser] = useState(null);

    // pri pokretanju aplikacije pokušaj učitati ulogovanog korisnika
    useEffect(() => {
        let mounted = true;
        async function loadUser() {
            try {
                const res = await api.get("/api/user"); // u tvom api.js možda je getUser()
                if (mounted) setUser(res.data || null);
            } catch (e) {
                // nije ulogovan ili greška
                setUser(null);
            }
        }
        loadUser();
        return () => (mounted = false);
    }, []);

    async function handleLogout() {
        try {
            await logoutUser();
        } catch (e) {
            // ignore
        }
        localStorage.removeItem("auth_token");
        setUser(null);
    }

    return (
        <Router>
            <Navbar user={user} onLogout={handleLogout} />
            <div style={{ paddingTop: 20 }}>
                <Routes>
                    <Route path="/" element={<HomePage />} />
                    <Route
                        path="/login"
                        element={<LoginPage setUser={setUser} />}
                    />
                    <Route path="/register" element={<RegisterPage />} />
                    <Route
                        path="/books/:id"
                        element={<BookPage user={user} />}
                    />
                    <Route
                        path="/subscription"
                        element={<SubscriptionPage user={user} />}
                    />
                    <Route path="/contact" element={<ContactPage />} />
                </Routes>
            </div>
        </Router>
    );
}

export default App;
