<x-app-layout>

<style>
.contenido {
  display: flex;
  align-items: center;
  gap: 40px;
  padding: 40px 60px;
}

.texto h2 {
  font-size: 42px;       
  line-height: 1.2;
  margin-bottom: 30px;
  color: #e86719;
}

.texto p {
  font-size: 19px;       
  line-height: 1.8;
  margin-bottom: 20px;
  max-width: 680px;      
}

.imagen img {
  width: 100%;     
  max-height: 420px;
  object-fit: cover;
  border-radius: 12px;
}

</style>

<section class="contenido">
  <div class="texto">
    <h2>La fuerza detrás de BAMX: el poder de los voluntarios</h2>
    <p>En BAMX, los voluntarios representan el corazón que impulsa cada una de nuestras acciones.</p>
    <p>Gracias a su tiempo y esfuerzo, logramos clasificar, empacar y distribuir toneladas de alimentos.</p>
    <p>Cada voluntario es una pieza fundamental en la lucha contra el hambre en México.</p>
  </div>

  <div class="imagen">
    <img src="{{ asset('img/bamx4.jpg') }}" alt="Voluntariado BAMX">
  </div>
</section>

<footer>
  <p>© 2025 <strong>BAMX</strong> | Nexunity Labs</p>
</footer>

</x-app-layout>
