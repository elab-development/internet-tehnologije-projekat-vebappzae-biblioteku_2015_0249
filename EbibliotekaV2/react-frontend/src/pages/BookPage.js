import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import api from "../services/api";
import Reader from "../components/Reader";
import Button from "../components/Button";

export default function BookPage({ user, onRequireLogin }) {
    const { id } = useParams();
    const [book, setBook] = useState(null);
    const nav = useNavigate();

    useEffect(() => {
        api.get(`/books/${id}`)
            .then((res) => setBook(res.data))
            .catch((err) => {
                console.error(err);
            });
    }, [id]);

    if (!book)
        return (
            <div className="container">
                <div className="text-muted">Učitavanje...</div>
            </div>
        );

    const isSubscribed = user && user.membership_level === "subscribed";

    const handleSubscribeClick = async () => {
        if (!user) {
            // ako nije logovan, zamoli ga da se loguje
            if (onRequireLogin) onRequireLogin();
            nav("/login");
            return;
        }

        // primer: POST /subscriptions
        try {
            await api.post("/subscriptions", { subscription_type: "monthly" });
            // refresh user data
            const me = await api.get("/me");
            // ovde se očekuje da spoljašnji state (App) ima setUser; caller treba da osveži user
            alert("Uspešno pretplaćeni! Osvežite stranicu.");
            // jednostavno reload da se vidi promena
            window.location.reload();
        } catch (err) {
            alert("Greška pri pretplati");
        }
    };

    return (
        <div className="container">
            <div style={{ display: "flex", gap: 20, alignItems: "flex-start" }}>
                <div style={{ flex: "1 1 60%" }}>
                    <h2 style={{ marginTop: 0 }}>{book.title}</h2>
                    <div className="text-muted">Autor: {book.author}</div>
                    <p style={{ marginTop: 12 }}>{book.description}</p>

                    <Reader
                        pages={book.pages || book.content_pages || []}
                        isSubscribed={isSubscribed}
                        onSubscribe={handleSubscribeClick}
                    />
                </div>

                <aside style={{ width: 260 }}>
                    <div className="form" style={{ padding: 12 }}>
                        <h4 style={{ margin: 0 }}>Radnje</h4>
                        <div
                            style={{
                                marginTop: 10,
                                display: "flex",
                                flexDirection: "column",
                                gap: 8,
                            }}
                        >
                            <Button
                                onClick={() =>
                                    alert(
                                        "Otvori reader (implementirati pravi reader)"
                                    )
                                }
                            >
                                Čitaj knjigu
                            </Button>
                            <Button
                                outline
                                onClick={() => {
                                    const review = prompt("Ostavi recenziju:");
                                    if (review)
                                        api.post(`/books/${id}/reviews`, {
                                            text: review,
                                        })
                                            .then(() =>
                                                alert("Recenzija poslata")
                                            )
                                            .catch(() => alert("Greška"));
                                }}
                            >
                                Ostavi recenziju
                            </Button>
                            <Button
                                outline
                                onClick={async () => {
                                    try {
                                        await api.post("/favorites", {
                                            book_id: id,
                                        });
                                        alert("Dodato u omiljene");
                                    } catch {
                                        alert("Greška");
                                    }
                                }}
                            >
                                Dodaj u omiljene
                            </Button>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    );
}
