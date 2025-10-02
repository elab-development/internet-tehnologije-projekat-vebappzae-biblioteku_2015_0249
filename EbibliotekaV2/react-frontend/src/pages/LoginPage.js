import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import { login } from "../services/api"; // koristimo login helper
import InputField from "../components/InputField";
import Button from "../components/Button";

export default function LoginPage({ setUser }) {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const nav = useNavigate();

    async function handleLogin(e) {
        e.preventDefault();
        try {
            const res = await login({ email, password });

            if (res.data.token) {
                localStorage.setItem("auth_token", res.data.token);
            }

            setUser(res.data.user || res.data);
            nav("/");
        } catch (err) {
            console.error("Login error:", err);
            alert(err?.response?.data?.message || "Greška pri logovanju");
        }
    }

    return (
        <div
            className="container"
            style={{ display: "flex", justifyContent: "center" }}
        >
            <form className="form" onSubmit={handleLogin}>
                <h2>Login</h2>
                <InputField
                    label="Email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    type="email"
                />
                <InputField
                    label="Lozinka"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    type="password"
                />
                <div style={{ display: "flex", gap: 10, marginTop: 8 }}>
                    <Button type="submit">Prijavi se</Button>
                    <Button outline onClick={() => nav("/register")}>
                        Registracija
                    </Button>
                </div>
            </form>
        </div>
    );
}
