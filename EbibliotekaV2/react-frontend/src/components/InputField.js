import React from "react";

// Reusable komponenta za input polja u formama
const InputField = ({ label, type = "text", value, onChange }) => (
  <div className="mb-3">
    <label className="form-label">{label}</label>
    <input
      type={type}
      className="form-control"
      value={value}
      onChange={onChange}
    />
  </div>
);

export default InputField;
