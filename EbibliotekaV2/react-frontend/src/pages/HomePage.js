import React, { useEffect, useState } from "react";
import api from "../services/api";
import BookCard from "../components/BookCard";
import { useNavigate } from "react-router-dom";

const HomePage = ({ user }) => {
  const [books, setBooks] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    // fetch svih knjiga
    api
      .get("/books")
      .then((res) => setBooks(res.data))
      .catch((err) => console.log(err));
  }, []);

  const handleOpenBook = (id) => {
    navigate(`/books/${id}`);
  };

  return (
    <div className="container mt-4">
      <h1>Digitalna biblioteka</h1>
      {!user?.subscription && (
        <p className="text-danger">
          Samo pretplaćeni korisnici mogu da vide kompletnu biblioteku.
        </p>
      )}
      <div className="d-flex flex-wrap">
        {books.map((book) => (
          <BookCard key={book.id} book={book} onOpen={handleOpenBook} />
        ))}
      </div>
    </div>
  );
};

export default HomePage;
