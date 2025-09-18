import React from "react";
import Button from "./Button";

const BookCard = ({ book, onOpen }) => {
  return (
    <div className="card m-2" style={{ width: "18rem" }}>
      <img src={book.image} className="card-img-top" alt={book.title} />
      <div className="card-body">
        <h5 className="card-title">{book.title}</h5>
        <p className="card-text">Autor: {book.author}</p>
        <Button text="Detalji" onClick={() => onOpen(book.id)} />
      </div>
    </div>
  );
};

export default BookCard;
