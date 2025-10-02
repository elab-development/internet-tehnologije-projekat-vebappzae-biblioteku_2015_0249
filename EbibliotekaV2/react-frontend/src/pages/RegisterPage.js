// src/pages/RegisterPage.jsx
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import api from "../services/api"; // više ne uzimamo getCsrfCookie
import InputField from "../components/InputField";
import Button from "../components/Button";

export default function RegisterPage() {
    const [first, setFirst] = useState("");
    const [last, setLast] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [passwordConfirm, setPasswordConfirm] = useState("");
    const [birthYear, setBirthYear] = useState("");
    const nav = useNavigate();

    async function handleRegister(e) {
        e.preventDefault();

        try {
            // Direktno ka Laravel API-ju
            await api.post("/api/register", {
                first_name: first,
                last_name: last,
                email,
                password,
                password_confirmation: passwordConfirm,
                birth_year: birthYear || null,
            });

            alert("Uspešno registrovan! Sada se prijavi.");
            nav("/login");
        } catch (err) {
            console.error("Greška pri registraciji:", err);
            alert(err?.response?.data?.message || "Greška pri registraciji");
        }
    }

    // Funkcija da ograničimo unos samo na cifre i max 4
    function handleBirthYearChange(e) {
        const value = e.target.value.replace(/\D/g, ""); // ukloni sve što nije broj
        if (value.length <= 4) {
            setBirthYear(value);
        }
    }

    return (
        <div className="container center" style={{ justifyContent: "center" }}>
            <form className="form" onSubmit={handleRegister}>
                <h2>Registracija</h2>

                <InputField
                    label="Ime"
                    value={first}
                    onChange={(e) => setFirst(e.target.value)}
                />
                <InputField
                    label="Prezime"
                    value={last}
                    onChange={(e) => setLast(e.target.value)}
                />
                <InputField
                    label="Email"
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <InputField
                    label="Lozinka"
                    type="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                />
                <InputField
                    label="Potvrdi lozinku"
                    type="password"
                    value={passwordConfirm}
                    onChange={(e) => setPasswordConfirm(e.target.value)}
                />
                <InputField
                    label="Godina rođenja"
                    type="text"
                    value={birthYear}
                    onChange={handleBirthYearChange}
                    placeholder="npr. 2000"
                />

                <Button type="submit">Registruj se</Button>
            </form>
        </div>
    );
}
