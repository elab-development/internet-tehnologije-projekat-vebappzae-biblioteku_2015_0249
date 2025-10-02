import React from "react";
import api from "../services/api";
import Button from "../components/Button";

export default function SubscriptionPage({ user }) {
  const handleSubscribe = async () => {
    if (!user) {
      alert("Prijavite se prvo.");
      return;
    }
    try {
      await api.post("/subscriptions", { subscription_type: "monthly" });
      alert("Uspešno pretplaćeni");
      window.location.reload();
    } catch (e) {
      alert("Greška pri pretplati");
    }
  };

  return (
    <div className="container">
      <div className="form">
        <h2>Pretplata</h2>
        <p className="text-muted">
          Pretplatom dobijate pun pristup svim knjigama.
        </p>
        <div style={{ display: "flex", gap: 12 }}>
          <Button onClick={handleSubscribe}>Pretplati se - mesečno</Button>
          <Button outline onClick={() => alert("Implementirati plaćanje")}>
            Godišnje
          </Button>
        </div>
      </div>
    </div>
  );
}
