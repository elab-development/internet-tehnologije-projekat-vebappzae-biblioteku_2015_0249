import React from "react";

export default function InputField({
  label,
  value,
  onChange,
  type = "text",
  placeholder = "",
}) {
  return (
    <div style={{ marginBottom: 12 }}>
      {label && (
        <label
          style={{
            display: "block",
            marginBottom: 6,
            fontSize: 13,
            color: "#374151",
          }}
        >
          {label}
        </label>
      )}
      <input
        value={value}
        onChange={onChange}
        type={type}
        placeholder={placeholder}
        style={{
          width: "100%",
          padding: "10px 12px",
          borderRadius: 10,
          border: "1px solid #e6e9ee",
          background: "#fff",
        }}
      />
    </div>
  );
}
