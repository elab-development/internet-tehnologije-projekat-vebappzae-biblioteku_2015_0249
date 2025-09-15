import React from 'react'

const OneBook = () => {
  return (
    <div className="card">
      <img 
  className="card-img-top" 
  src="/images/Capture.png" 
  alt="Atomske navike - James Clear" 
/>
      <div className="card-body">
        <h3 className="card-title">Book tittle</h3>
        <p className="card-text">
          Book description where we can read more details about it.
        </p>
        <a className="btn">+</a>
        <a className="btn">-</a>
      </div>
    </div>

  )
}

export default OneBook;