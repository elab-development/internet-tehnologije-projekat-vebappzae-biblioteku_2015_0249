import React from "react";
import { Link } from "react-router-dom";
import Button from "./Button";

const NavBar = ({ user, onLogout }) => {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light">
      <div className="container-fluid">
        <Link className="navbar-brand" to="/">
          Biblioteka
        </Link>
        <div className="d-flex">
          {user ? (
            <>
              <span className="navbar-text me-2">{user.first_name}</span>
              <Button text="Logout" onClick={onLogout} />
            </>
          ) : (
            <>
              <Link to="/login" className="btn btn-outline-primary me-2">
                Login
              </Link>
              <Link to="/register" className="btn btn-outline-secondary">
                Register
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
};

export default NavBar;
