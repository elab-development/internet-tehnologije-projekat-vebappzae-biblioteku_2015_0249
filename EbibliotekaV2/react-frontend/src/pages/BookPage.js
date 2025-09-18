import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import api from "../services/api";
import Button from "../components/Button";

// Stranica za prikaz detalja knjige
const BookPage = () => {
  const { id } = useParams(); // čita id knjige iz URL-a
  const [book, setBook] = useState(null);

  useEffect(() => {
    api
      .get(`/books/${id}`)
      .then((res) => setBook(res.data))
      .catch((err) => console.log(err));
  }, [id]);

  const handleFavorite = () => {
    api
      .post("/favorites", { book_id: id })
      .then(() => alert("Knjiga dodata u omiljene"))
      .catch(() => alert("Greška pri dodavanju"));
  };

  if (!book) return <p>Učitavanje...</p>;

  return (
    <div className="container mt-4">
      <h2>{book.title}</h2>
      <p>{book.description}</p>
      <div className="d-flex">
        <Button text="Čitaj knjigu" onClick={() => alert("Otvaranje knjige")} />
        <Button
          text="Ostavi recenziju"
          className="ms-2"
          onClick={() => alert("Dodaj recenziju")}
        />
        <Button
          text="Daj ocenu"
          className="ms-2"
          onClick={() => alert("Oceni knjigu")}
        />
        <Button text="Omiljeno" className="ms-2" onClick={handleFavorite} />
      </div>
    </div>
  );
};

export default BookPage;
