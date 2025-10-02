// src/pages/HomePage.js
import React from "react";
import BookCard from "../components/BookCard";

function HomePage() {
  const books = [
    {
      id: 1,
      title: "Na Drini ćuprija",
      author: "Ivo Andrić",
      image: "/images/nadrinicuprija.png",
    },
    {
      id: 2,
      title: "Prokleta Avlija",
      author: "Ivo Andrić",
      image: "/images/prokletaavlija.jpg",
    },
    {
      id: 3,
      title: "Seobe",
      author: "Miloš Crnjanski",
      image: "/images/seobe.jpg",
    },
    {
      id: 4,
      title: "Zona Zamfirova",
      author: "Stevan Sremac",
      image: "/images/zonazamfirova.jpg",
    },
    {
      id: 5,
      title: "Ana Karenjina",
      author: "Lav Tolstoj",
      image: "/images/anakarenjina.jpg",
    },
    {
      id: 6,
      title: "Zločin i kazna",
      author: "Fjodor Mihailovič Dostojevski",
      image: "/images/zlocinikazna.jpg",
    },
  ];

  return (
    <div style={styles.container}>
      <h1 style={styles.heading}>Biblioteka</h1>
      <div style={styles.grid}>
        {books.map((book) => (
          <BookCard
            key={book.id}
            id={book.id} // prosleđuje ID
            title={book.title}
            author={book.author}
            image={book.image}
          />
        ))}
      </div>
    </div>
  );
}

const styles = {
  container: {
    padding: "20px",
  },
  heading: {
    textAlign: "center",
    fontSize: "28px",
    marginBottom: "30px",
  },
  grid: {
    display: "grid",
    gridTemplateColumns: "repeat(auto-fit, minmax(200px, 1fr))",
    gap: "20px",
  },
};

export default HomePage;
