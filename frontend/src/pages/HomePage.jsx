import React from 'react';
import 'aframe'; 

export default function HomePage() {
  return (
    <div>
      <div style={{ marginBottom: '2rem' }}>
        <h1>Bienvenue sur notre outil de Data Storytelling</h1>
        <p>
          Cette plateforme (CMS) est conçue pour créer des narrations de données (data storytelling) 
          dynamiques et interactives à partir de simples fichiers CSV ou d'APIs.
        </p>
      </div>

      <p>Découvrez notre outil (visualisation 3D indicative) :</p>

      <a-scene embedded style={{ height: '450px', width: '100%', border: '1px solid #ccc' }}>

        <a-assets>
          <a-mixin 
            id="font" 
            text="font: https://cdn.aframe.io/fonts/mozillavr.fnt"
          ></a-mixin>
        </a-assets>

        <a-entity 
          text="value: SAE 5012\nData Storytelling CMS; 
                 mixin: font; 
                 align: center; 
                 color: #333;" 
          position="0 2.5 -5"
        ></a-entity>

        <a-box 
          position="-1 1 -3" 
          rotation="0 45 0" 
          color="#4CC3D9" 
          shadow
        >
          <a-animation 
            attribute="rotation" 
            dur="10000" 
            fill="forwards" 
            to="0 405 0" 
            repeat="indefinite"
          ></a-animation>
        </a-box>

        <a-sphere 
          position="0 1.25 -5" 
          radius="1.25" 
          color="#EF2D5E" 
          shadow
        ></a-sphere>

        <a-cylinder 
          position="1 1.2 -3" 
          radius="0.5" 
          height="2" 
          color="#FFC65D" 
          shadow
        ></a-cylinder>

        <a-plane 
          position="0 0 -4" 
          rotation="-90 0 0" 
          width="10" 
          height="10" 
          color="#7BC8A4" 
          shadow
        ></a-plane>

        <a-sky color="#ECECEC"></a-sky>

        <a-light type="directional" color="#FFF" intensity="0.7" position="-1 2 1"></a-light>
        <a-light type="ambient" color="#AAA"></a-light>
      </a-scene>
    </div>
  );
}