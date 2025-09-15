import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Home from './pages/Home';
import LoginRegister from './pages/LoginRegister';
import BookDetail from './pages/BookDetail';
 
function App() {
  return (
<Routes>
<Route path="/" element={<Home />} />
<Route path="/login" element={<LoginRegister />} />
<Route path="/book/:id" element={<BookDetail />} />
</Routes>
  );
}
 
export default App;
