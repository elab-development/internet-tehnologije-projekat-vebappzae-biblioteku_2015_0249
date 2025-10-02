import React from "react";

export default function Button({
  children,
  onClick,
  className = "",
  outline = false,
  type = "button",
}) {
  return (
    <button
      type={type}
      onClick={onClick}
      className={`btn ${outline ? "outline" : ""} ${className}`}
    >
      {children}
    </button>
  );
}
