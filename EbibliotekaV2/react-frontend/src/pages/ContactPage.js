// src/pages/ContactPage.jsx
import React, { useState } from "react";
import InputField from "../components/InputField";
import Button from "../components/Button";

export default function ContactPage() {
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [msg, setMsg] = useState("");

    function handleSend(e) {
        e.preventDefault();
        // Simulacija: u real app pošalji na backend
        alert(`Poruka poslata: \nOd: ${name} (${email})\n\n${msg}`);
        setName("");
        setEmail("");
        setMsg("");
    }

    return (
        <div className="container" style={{ maxWidth: 720 }}>
            <h2>Kontakt</h2>
            <p className="text-muted">Pošaljite pitanje ili predlog.</p>
            <form onSubmit={handleSend}>
                <InputField
                    label="Ime"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                />
                <InputField
                    label="Email"
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                />
                <label style={{ display: "block", marginBottom: 6 }}>
                    Poruka
                </label>
                <textarea
                    value={msg}
                    onChange={(e) => setMsg(e.target.value)}
                    rows={6}
                    style={{
                        width: "100%",
                        padding: 10,
                        borderRadius: 8,
                        border: "1px solid #e6e9ee",
                    }}
                />
                <div style={{ marginTop: 10 }}>
                    <Button type="submit">Pošalji</Button>
                </div>
            </form>
        </div>
    );
}
