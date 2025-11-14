import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import { Chart as ChartJS, ArcElement, Tooltip, Legend, CategoryScale, LinearScale, BarElement, PointElement, LineElement } from 'chart.js';
import { Pie, Bar } from 'react-chartjs-2';

ChartJS.register(ArcElement, Tooltip, Legend, CategoryScale, LinearScale, BarElement, PointElement, LineElement);

function RenderBlock({ block }) {
  switch (block.type) {
    case 'title':
      return <h2>{block.content}</h2>;
    case 'text':
      return <p style={{whiteSpace: 'pre-wrap'}}>{block.content}</p>;
    case 'image':
      return <img src={`https://via.placeholder.com/600x300.png?text=${block.content}`} alt={block.content} style={{ maxWidth: '100%' }} />;

    case 'visualization': {
      const demoData = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [
          {
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
          },
        ],
      };
      return (
        <div style={{ maxWidth: '400px', margin: 'auto' }}>
          <h3>Graphique de démo (Pie)</h3>
          <Pie data={demoData} />
        </div>
      );
    }

    default:
      return <p><i>Type de bloc inconnu: {block.type}</i></p>;
  }
}

export default function ArticleDetailPage() {
  const { id } = useParams();
  const [article, setArticle] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get(`/api/articles/${id}`)
      .then(response => {
        setArticle(response.data);
        setLoading(false);
      })
      .catch(error => {
        console.error("Erreur API:", error);
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return <p>Chargement de l'article...</p>;
  }

  if (!article) {
    return <p>Article non trouvé.</p>;
  }

  return (
    <article>
      <h1>{article.title}</h1>
      <p><em>{article.summary}</em></p>
      <hr />

      {article.blocks
        .sort((a, b) => a.ordering - b.ordering)
        .map(block => (
          <RenderBlock key={block.id} block={block} />
      ))}
    </article>
  );
}