// src/components/BookCard.js
import React from "react";
import { useNavigate } from "react-router-dom";

function BookCard({ id, title, author, image }) {
  const nav = useNavigate();

  return (
    <div className="book-card" onClick={() => nav(`/books/${id}`)}>
      <img src={image} alt={title} style={styles.image} />
      <h3 style={styles.title}>{title}</h3>
      <p style={styles.author}>{author}</p>
    </div>
  );
}

const styles = {
  card: {
    border: "1px solid #ddd",
    borderRadius: "10px",
    padding: "15px",
    textAlign: "center",
    backgroundColor: "#fff",
    boxShadow: "0 2px 6px rgba(0,0,0,0.1)",
    transition: "transform 0.2s ease, box-shadow 0.2s ease",
    cursor: "pointer",
  },
  image: {
    width: "100%",
    height: "200px",
    objectFit: "contain", // cela slika uvek vidljiva
    borderRadius: "8px",
    marginBottom: "10px",
  },
  title: {
    fontSize: "18px",
    margin: "5px 0",
    fontWeight: "bold",
  },
  author: {
    fontSize: "14px",
    color: "#666",
  },
};

export default BookCard;
