import React, { useEffect, useState } from "react";
import axios from "axios";
import BookCard from "../components/BookCard";

export default function HomePage() {
    const [books, setBooks] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios
            .get("http://127.0.0.1:8000/api/books")
            .then((res) => {
                setBooks(res.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error("Greška pri učitavanju knjiga:", err);
                setLoading(false);
            });
    }, []);

    if (loading) {
        return (
            <div className="text-center mt-5">
                <div
                    className="spinner-border text-primary"
                    role="status"
                ></div>
                <p className="mt-3 text-secondary">Učitavanje knjiga...</p>
            </div>
        );
    }

    return (
        <div className="container py-5">
            <h1 className="text-center mb-5 text-primary fw-bold">
                📚 Naše knjige
            </h1>

            {books.length === 0 ? (
                <p className="text-center text-muted">Nema dostupnih knjiga.</p>
            ) : (
                <div className="row g-4">
                    {books.map((book) => (
                        <div
                            key={book.id}
                            className="col-12 col-sm-6 col-md-4 col-lg-3"
                        >
                            <BookCard
                                id={book.id}
                                title={book.title}
                                author={book.author}
                                image={book.image}
                            />
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}
