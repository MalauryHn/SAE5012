import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default function ArticleListPage() {
  const [articles, setArticles] = useState([]); 
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    console.log("ArticleListPage: Démarrage de l'appel API...");
    axios.get('/api/articles')
      .then(response => {
        console.log("ArticleListPage: Réponse API reçue", response.data); 

        if (response.data && 'member' in response.data) {

          const articlesData = response.data['member'];

          if (Array.isArray(articlesData)) {
            setArticles(articlesData);
          } else {
            console.error("ArticleListPage: 'member' n'est pas un tableau !", articlesData);
            setArticles([]); 
          }

        } else {
          if (Array.isArray(response.data)) {
            setArticles(response.data);
          } else {
            console.error("ArticleListPage: Réponse API dans un format inconnu (ne trouve pas 'member').", response.data);
            setArticles([]);
          }
        }

        setLoading(false);
      })
      .catch(error => {
        console.error("ArticleListPage: Erreur lors de l'appel API:", error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p>Chargement des articles...</p>;
  }

  return (
    <div>
      <h1>Articles de Data Storytelling</h1>
      <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
        
        {articles && articles.length > 0 ? (
          articles.map(article => (
            <article key={article.id} style={{ border: '1px solid #ccc', padding: '1rem' }}>
              <h2>
                <Link to={`/articles/${article.id}`}>{article.title}</Link>
              </h2>
              <p>{article.summary}</p>
              
              <small>
                Par {article.author?.username || 'Auteur inconnu'} le {new Date(article.createdAt).toLocaleDateString()}
              </small>
            </article>
          ))
        ) : (
          <p>Aucun article trouvé. Créez-en un dans le <a href="/admin" target="_blank">backoffice</a> !</p>
        )}
      </div>
    </div>
  );
}