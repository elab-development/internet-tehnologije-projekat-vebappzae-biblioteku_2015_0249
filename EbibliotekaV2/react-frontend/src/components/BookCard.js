// src/components/BookCard.jsx
import React from "react";
import { Link } from "react-router-dom";
import Button from "./Button";

export default function BookCard({ id, title, author, image }) {
    return (
        <div style={cardStyle}>
            <img
                src={image || "https://via.placeholder.com/200x260?text=Knjiga"}
                alt={title}
                style={{
                    width: "100%",
                    height: 260,
                    objectFit: "cover",
                    borderRadius: 8,
                }}
            />
            <h3 style={{ margin: "10px 0 6px 0", fontSize: 18 }}>{title}</h3>
            <div style={{ color: "#555", marginBottom: 12 }}>{author}</div>
            <div style={{ display: "flex", gap: 8 }}>
                <Link
                    to={`/books/${id}`}
                    style={{ textDecoration: "none", flex: 1 }}
                >
                    <Button>Detalji</Button>
                </Link>
                <Button
                    outline
                    onClick={() => alert("Dodato u korpu / omiljene (sim.)")}
                >
                    ❤️
                </Button>
            </div>
        </div>
    );
}

const cardStyle = {
    border: "1px solid #e6e9ee",
    borderRadius: 12,
    padding: 12,
    background: "#fff",
    display: "flex",
    flexDirection: "column",
};
