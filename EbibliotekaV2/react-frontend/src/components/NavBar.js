import React from "react";
import { Link, useNavigate } from "react-router-dom";
import Button from "./Button";

export default function NavBar({ user, onLogout }) {
  const nav = useNavigate();
  return (
    <header
      className="navbar container"
      style={{ paddingTop: 12, paddingBottom: 12 }}
    >
      <div className="brand">
        <Link to="/" style={{ textDecoration: "none", color: "var(--accent)" }}>
          E-Biblioteka
        </Link>
      </div>

      <div className="nav-actions">
        <Link
          to="/"
          style={{ textDecoration: "none", color: "#374151", marginRight: 12 }}
        >
          Knjige
        </Link>
        {user ? (
          <>
            <div style={{ color: "#374151", marginRight: 10 }}>
              {user.first_name}
            </div>
            <Button onClick={() => onLogout()}>Logout</Button>
          </>
        ) : (
          <>
            <Button onClick={() => nav("/login")} className="outline">
              Login
            </Button>
            <Button onClick={() => nav("/register")} className="outline">
              Register
            </Button>
          </>
        )}
      </div>
    </header>
  );
}
