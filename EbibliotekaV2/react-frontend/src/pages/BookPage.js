// src/pages/BookPage.js
import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";

export default function BookPage() {
    const { id } = useParams(); // /books/:id
    const [book, setBook] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        // napravi axios instancu sa withCredentials
        const api = axios.create({
            baseURL: "http://127.0.0.1:8000/api",
            withCredentials: true,
        });

        api.get(`/books/${id}`)
            .then((res) => {
                setBook(res.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error("Greška kod dohvatanja knjige:", err);
                setError("Ne mogu da učitam podatke o knjizi.");
                setLoading(false);
            });
    }, [id]);

    if (loading) return <p>Učitavanje...</p>;
    if (error) return <p style={{ color: "red" }}>{error}</p>;
    if (!book) return <p>Knjiga nije pronađena.</p>;

    return (
        <div style={{ maxWidth: 600, margin: "0 auto" }}>
            <h1>{book.title}</h1>
            <h3 style={{ color: "#555" }}>{book.author}</h3>
            <img
                src={
                    book.image ||
                    "https://via.placeholder.com/300x400?text=Knjiga"
                }
                alt={book.title}
                style={{ width: "100%", maxWidth: 300, borderRadius: 8 }}
            />
            <p style={{ marginTop: 20, whiteSpace: "pre-line" }}>
                {book.content || "Nema sadržaja za prikaz."}
            </p>
        </div>
    );
}
