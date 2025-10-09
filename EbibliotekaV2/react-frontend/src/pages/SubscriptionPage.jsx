import React, { useState } from "react";
import api from "../services/api.js";
import Button from "../components/Button";
import { useNavigate } from "react-router-dom"; // <--- dodaj ovo

export default function SubscriptionPage({ user }) {
    const [type, setType] = useState("monthly");
    const [loading, setLoading] = useState(false);
    const navigate = useNavigate(); // <--- dodaj ovo

    const handleSubscribe = async () => {
        if (!user) {
            alert("Morate biti prijavljeni da biste se pretplatili.");
            return;
        }

        try {
            setLoading(true);
            await api.post("/subscriptions", { type });

            alert("Pretplata uspešno aktivirana!");

            // Vrati korisnika na prethodnu stranicu (npr. knjigu)
            navigate(-1);
        } catch (error) {
            console.error("Greška pri pretplati:", error);
            alert(
                error.response?.data?.message ||
                    "Došlo je do greške pri pretplati."
            );
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="container" style={styles.container}>
            <h2>Pretplata</h2>
            <p style={{ color: "#666" }}>
                Izaberite trajanje pretplate da biste dobili pun pristup
                knjigama.
            </p>

            <select
                value={type}
                onChange={(e) => setType(e.target.value)}
                style={styles.select}
            >
                <option value="monthly">Mesečna</option>
                <option value="6months">Šestomesečna</option>
                <option value="yearly">Godišnja</option>
            </select>

            <Button onClick={handleSubscribe} disabled={loading}>
                {loading ? "Obrada..." : "Pretplati se"}
            </Button>
        </div>
    );
}

const styles = {
    container: {
        maxWidth: 400,
        margin: "40px auto",
        padding: 20,
        border: "1px solid #e5e5e5",
        borderRadius: 10,
        background: "#fff",
        textAlign: "center",
    },
    select: {
        width: "100%",
        padding: 10,
        borderRadius: 6,
        border: "1px solid #ccc",
        marginBottom: 20,
    },
};
