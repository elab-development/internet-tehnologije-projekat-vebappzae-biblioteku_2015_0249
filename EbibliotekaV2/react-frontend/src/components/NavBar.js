import React from "react";
import { Link, useNavigate } from "react-router-dom";
import Button from "./Button";

const NavBar = ({ user, onLogout }) => {
  const navigate = useNavigate();

  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <Link className="navbar-brand" to="/">
        Digitalna biblioteka
      </Link>
      <div className="ml-auto">
        {user ? (
          <>
            <span className="me-2">Zdravo, {user.first_name}</span>
            <Button text="Logout" onClick={onLogout} />
          </>
        ) : (
          <Button text="Login" onClick={() => navigate("/login")} />
        )}
      </div>
    </nav>
  );
};

export default NavBar;
