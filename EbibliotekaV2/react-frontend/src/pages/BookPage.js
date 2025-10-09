// src/pages/BookPage.js
import React, { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import api from "../services/api";

export default function BookPage() {
    const { id } = useParams();
    const [book, setBook] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        async function fetchBook() {
            try {
                const res = await api.get(`/books/${id}`);
                setBook(res.data);
            } catch (err) {
                console.error("Greška kod dohvatanja knjige:", err);
                setError("Ne mogu da učitam podatke o knjizi.");
            } finally {
                setLoading(false);
            }
        }
        fetchBook();
    }, [id]);

    if (loading) return <p>Učitavanje...</p>;
    if (error) return <p style={{ color: "red" }}>{error}</p>;
    if (!book) return <p>Knjiga nije pronađena.</p>;

    const displayContent = book.is_subscribed
        ? book.content
        : (book.content || "").slice(0, 10) +
          "... Pretplati se da vidiš ceo tekst!";

    return (
        <div
            style={{ maxWidth: 600, margin: "40px auto", textAlign: "center" }}
        >
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
                {displayContent}
            </p>

            {!book.is_subscribed && (
                <Link
                    to="/subscription"
                    style={{ color: "#007bff", textDecoration: "underline" }}
                >
                    Aktiviraj pretplatu →
                </Link>
            )}
        </div>
    );
}
