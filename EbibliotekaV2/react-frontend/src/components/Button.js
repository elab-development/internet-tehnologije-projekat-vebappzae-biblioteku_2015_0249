import React from "react";

const Button = ({ text, onClick, type = "button", className = "" }) => {
  return (
    <button
      className={`btn btn-primary ${className}`}
      onClick={onClick}
      type={type}
    >
      {text}
    </button>
  );
};

export default Button;
