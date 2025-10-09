// src/pages/LoginPage.jsx
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { login, getUser, getCsrfCookie } from "../services/api";
import InputField from "../components/InputField";
import Button from "../components/Button";

export default function LoginPage({ setUser }) {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [loading, setLoading] = useState(false);
    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            setLoading(true);

            const res = await login({ email, password });
            const token =
                res.data?.token ||
                res.data?.access_token ||
                res.data?.meta?.token;
            if (token) {
                localStorage.setItem("auth_token", token);
            }

            const userRes = await getUser();
            setUser(userRes.data || null);

            navigate("/");
        } catch (err) {
            console.error(err);
            alert(err.response?.data?.message || "Greška pri prijavi");
        } finally {
            setLoading(false);
        }
    };

    return (
        <div
            className="container"
            style={{ maxWidth: 420, margin: "40px auto" }}
        >
            <h2>Prijava</h2>
            <form onSubmit={handleSubmit}>
                <InputField
                    label="Email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <InputField
                    label="Lozinka"
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                />
                <Button type="submit" disabled={loading}>
                    {loading ? "Obrada..." : "Prijavi se"}
                </Button>
            </form>
        </div>
    );
}
