import React from "react";
import { Link, useNavigate } from "react-router-dom";

export default function NavBar({ user, onLogout }) {
    const nav = useNavigate();

    return (
        <nav
            className="navbar navbar-expand-lg shadow-sm"
            style={{ backgroundColor: "#1E3A8A" }}
        >
            <div className="container-fluid px-4">
                {/*  Brand */}
                <Link
                    className="navbar-brand fw-bold text-white fs-4"
                    to="/"
                    style={{ letterSpacing: "0.5px" }}
                >
                    📚 E-Biblioteka
                </Link>

                {/*  Hamburger */}
                <button
                    className="navbar-toggler bg-light"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span className="navbar-toggler-icon"></span>
                </button>

                {/* Linkovi + desna strana */}
                <div
                    className="collapse navbar-collapse justify-content-between"
                    id="navbarNav"
                >
                    {/* Leva strana — linkovi */}
                    <ul className="navbar-nav">
                        <li className="nav-item">
                            <Link className="nav-link text-white" to="/">
                                Knjige
                            </Link>
                        </li>
                        <li className="nav-item">
                            <Link
                                className="nav-link text-white"
                                to="/subscription"
                            >
                                Pretplata
                            </Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link text-white" to="/contact">
                                Kontakt
                            </Link>
                        </li>
                    </ul>

                    {/* Desna strana — korisnik ili login/register */}
                    <div className="d-flex align-items-center">
                        {user ? (
                            <div className="d-flex align-items-center gap-3">
                                <span className="text-white fw-semibold">
                                    👋 {user.first_name}
                                </span>
                                <button
                                    className="btn btn-outline-light btn-sm"
                                    onClick={onLogout}
                                >
                                    Logout
                                </button>
                            </div>
                        ) : (
                            <div
                                className="
                                    d-flex 
                                    flex-lg-row flex-column 
                                    align-items-lg-center align-items-start 
                                    gap-2
                                "
                            >
                                <button
                                    className="btn btn-light btn-sm"
                                    onClick={() => nav("/login")}
                                    style={{
                                        fontWeight: "500",
                                        color: "#1E3A8A",
                                        width: "100px",
                                    }}
                                >
                                    Login
                                </button>
                                <button
                                    className="btn btn-outline-light btn-sm"
                                    onClick={() => nav("/register")}
                                    style={{
                                        fontWeight: "500",
                                        width: "100px",
                                    }}
                                >
                                    Register
                                </button>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </nav>
    );
}
