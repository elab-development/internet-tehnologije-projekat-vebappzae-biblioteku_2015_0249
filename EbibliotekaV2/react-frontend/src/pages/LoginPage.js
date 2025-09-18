import React, { useState } from "react";
import api from "../services/api";
import InputField from "../components/InputField";
import Button from "../components/Button";
import { useNavigate } from "react-router-dom";

// Stranica za login
const LoginPage = ({ setUser }) => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleLogin = async () => {
    try {
      // POST zahtev na Laravel backend za login
      const res = await api.post("/login", { email, password });
      setUser(res.data.user); // backend treba da vrati user objekat
      navigate("/"); // posle login-a ide na početnu
    } catch (err) {
      alert("Greška pri logovanju");
    }
  };

  return (
    <div className="container mt-4">
      <h2>Login</h2>
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
      <Button text="Login" onClick={handleLogin} />
      <Button
        text="Pretplata"
        className="ms-2"
        onClick={() => navigate("/subscription")}
      />
    </div>
  );
};

export default LoginPage;
