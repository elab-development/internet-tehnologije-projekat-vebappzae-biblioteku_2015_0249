import React from 'react';

import { Link } from 'react-router-dom';
 
const NavBar = ({ user }) => {

  return (
<nav className="navBar">
<Link to="/">E-biblioteka</Link>

      {user ? (
<>
<span>Hi, {user.first_name}</span>
<Link to="/logout">Logout</Link>
</>

      ) : (
<Link to="/login">Login / Register</Link>

      )}
</nav>

  );

}
 
export default NavBar;

 