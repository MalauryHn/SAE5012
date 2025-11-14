import React from 'react';
import { Link } from 'react-router-dom';

const navStyle = {
  backgroundColor: '#333',
  padding: '1rem',
  display: 'flex',
  justifyContent: 'space-between',
  alignItems: 'center'
};

const ulStyle = {
  listStyle: 'none',
  display: 'flex',
  gap: '20px',
  margin: 0,
  padding: 0
};

const linkStyle = {
  color: 'white',
  textDecoration: 'none',
  fontSize: '1.1rem'
};

const logoStyle = {
  ...linkStyle,
  fontSize: '1.5rem',
  fontWeight: 'bold'
};

export default function Navbar() {
  return (
    <nav style={navStyle}>
      <Link to="/" style={logoStyle}>SAE 5012</Link>
      <ul style={ulStyle}>
        <li>
          <Link to="/" style={linkStyle}>Accueil</Link>
        </li>
        <li>
          <Link to="/articles" style={linkStyle}>Articles</Link>
        </li>
        <li>
          <a href="/admin" style={linkStyle} target="_blank" rel="noopener noreferrer">
            Backoffice
          </a>
        </li>
      </ul>
    </nav>
  );
}