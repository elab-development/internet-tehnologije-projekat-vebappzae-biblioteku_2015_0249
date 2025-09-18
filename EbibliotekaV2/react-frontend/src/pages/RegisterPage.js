import React, { useState } from "react";
import api from "../services/api";
import InputField from "../components/InputField";
import Button from "../components/Button";
import { useNavigate } from "react-router-dom";

// Stranica za registraciju korisnika
const RegisterPage = () => {
  const [firstName, setFirstName] = useState("");
  const [lastName, setLastName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleRegister = async () => {
    try {
      await api.post("/register", {
        first_name: firstName,
        last_name: lastName,
        email,
        password,
      });
      alert("Uspešna registracija!");
      navigate("/login");
    } catch (err) {
      alert("Greška pri registraciji");
    }
  };

  return (
    <div className="container mt-4">
      <h2>Registracija</h2>
      <InputField
        label="Ime"
        value={firstName}
        onChange={(e) => setFirstName(e.target.value)}
      />
      <InputField
        label="Prezime"
        value={lastName}
        onChange={(e) => setLastName(e.target.value)}
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
      <Button text="Registruj se" onClick={handleRegister} />
    </div>
  );
};

export default RegisterPage;
