<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Voluntariado de Banco de alimentos Guadalajara</title>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet" />
</head>


<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Montserrat', sans-serif;
  background-color: #fefefe;
  color: #222;
  line-height: 1.6;
}


header {
  background-color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 40px;
  border-bottom: 8px solid #e86719;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.logo-titulo {
  display: flex;
  align-items: center;
}

.logo {
  height: 100px;
  margin-right: 20px;
}

.titulo {
  font-size: 32px;
  font-weight: 800;
  color: #e86719;
}

nav {
  display: flex;
  gap: 30px;
}

nav a {
  text-decoration: none;
  font-size: 18px;
  font-weight: 600;
  color: #e86719;
  position: relative;
}

nav a::after {
  content: '';
  display: block;
  width: 0;
  height: 2px;
  background: #e86719;
  transition: width 0.3s;
  position: absolute;
  bottom: -5px;
  left: 0;
}

nav a:hover::after {
  width: 100%;
}

main {
  padding: 40px;
}

.contenido {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  align-items: center;
  justify-content: space-between;
}

.texto {
  flex: 1;
  min-width: 300px;
}

.texto h2 {
  font-size: 28px;
  margin-bottom: 20px;
  color: #e86719;
}

.texto p {
  margin-bottom: 15px;
  font-size: 16px;
}

.imagen img {
  width: 720px;
  height: 380px;
  object-fit: cover;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  transition: opacity 1.2s ease-in-out;
}


footer {
  background-color: #e86719;
  color: white;
  text-align: center;
  padding: 20px;
  font-weight: 600;
  margin-top: 60px;

}


.login-contenido {
  max-width: 400px;
  margin: 60px auto;
  padding: 30px 40px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(232, 103, 25, 0.2);
  text-align: center;
}

.login-contenido h2 {
  color: #e86719;
  margin-bottom: 25px;
  font-weight: 800;
  font-size: 28px;
}

.login-form {
  display: flex;
  flex-direction: column;
  gap: 18px;
  text-align: left;
}

.login-form label {
  font-weight: 600;
  color: #444;
  margin-bottom: 5px;
}

.login-form input {
  padding: 12px 15px;
  font-size: 16px;
  border: 2px solid #e86719;
  border-radius: 8px;
  outline-color: #e86719;
  transition: border-color 0.3s ease;
}

.login-form input:focus {
  border-color: #bf4f13;
}

.login-form button {
  margin-top: 10px;
  padding: 12px 0;
  background-color: #e86719;
  border: none;
  border-radius: 8px;
  color: white;
  font-weight: 700;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-form button:hover {
  background-color: #bf4f13;
}

/* Estilos específicos para el registro de entrada */

/* Reset básico */
* 

{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* BODY */
body {
  font-family: 'Montserrat', sans-serif;
  background-color: #fefefe;
  color: #222;
  line-height: 1.6;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* HEADER */
header {
  background-color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 40px;
  border-bottom: 8px solid #e86719;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.logo-titulo {
  display: flex;
  align-items: center;
}

.logo {
  height: 100px;
  margin-right: 20px;
}

.titulo {
  font-size: 32px;
  font-weight: 800;
  color: #e86719;
}

nav {
  display: flex;
  gap: 30px;
}

nav a {
  text-decoration: none;
  font-size: 18px;
  font-weight: 600;
  color: #e86719;
  position: relative;
}

nav a::after {
  content: '';
  display: block;
  width: 0;
  height: 2px;
  background: #e86719;
  transition: width 0.3s;
  position: absolute;
  bottom: -5px;
  left: 0;
}

nav a:hover::after {
  width: 100%;
}

/* CONTENIDO PRINCIPAL - FLEX 1 para que footer quede abajo */
.registro-contenido {
  max-width: 400px;
  margin: 40px auto;
  padding: 30px 40px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(30, 64, 175, 0.15);
  text-align: center;
  flex: 1;
}

/* TÍTULO */
.registro-contenido h2 {
  color: #1e40af;
  margin-bottom: 25px;
  font-weight: 800;
  font-size: 26px;
}

/* QR Reader */
#qr-reader {
  border: 2px dashed #1e40af;
  border-radius: 12px;
  padding: 15px;
  margin-bottom: 20px;
  background-color: #fff;
  width: 100%;
  max-width: 300px;
  margin-left: auto;
  margin-right: auto;
}

/* FORMULARIO */
.registro-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  text-align: left;
  max-width: 300px;
  margin: 0 auto;
}

.registro-form input {
  padding: 12px;
  font-size: 16px;
  border: 2px solid #1e3a8a;
  border-radius: 8px;
  outline-color: #1e3a8a;
}

.registro-form button {
  background-color: #e86719; /* NARANJA */
  color: white;
  font-weight: 700;
  border: none;
  border-radius: 8px;
  padding: 12px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.registro-form button:hover {
  background-color: #bf4f13;
}

/* MENSAJE */
#mensaje {
  margin-top: 15px;
  font-weight: bold;
  color: #1e3a8a;
  text-align: center;
}

/* FOOTER */
footer {
  background-color: #e86719;
  color: white;
  text-align: center;
  padding: 20px;
  font-weight: 600;
  margin-top: auto; /* para pegar abajo */
}

#slider {
  transition: opacity 1.2s ease-in-out;
}

</style>
<body>

  <!-- Header -->
  <header>
    <div class="logo-titulo">
      <img src="{{ asset('img/logo.png') }}" alt="Logo BAMX" class="logo">
      <h1 class="titulo">VOLUNTARIADO</h1>
    </div>
    <nav>
      <a href="#">Inicio</a>
      
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Página principal</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ingresa</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrate</a>
                        @endif
                    @endauth
              
            @endif
      
    </nav>
  </header>

  <!-- Main content -->
  <main>
    <section class="contenido">
      <div class="texto">
        <h2>La fuerza detrás de BAMX: el poder de los voluntarios</h2>
        <p>En BAMX, los voluntarios representan el corazón que impulsa cada una de nuestras acciones. Su entrega, compromiso y generosidad hacen posible que miles de familias mexicanas en situación vulnerable reciban alimentos de calidad día tras día.</p>
        <p>Gracias a su tiempo y esfuerzo, logramos clasificar, empacar y distribuir toneladas de alimentos rescatados, asegurando que lleguen a quienes más lo necesitan.</p>
        <p>Cada voluntario es una pieza fundamental en la lucha contra el hambre y la malnutrición en México. Su participación fortalece nuestro impacto y nos recuerda que, unidos, podemos lograr un país más justo y generoso.</p>
      </div>
      <div class="imagen">
  <img 
    id="slider"
    src="{{ asset('img/bamx1.jpg') }}" 
    alt="Voluntariado BAMX">
</div>

    </section>
  </main>

  <!-- Footer -->
  <footer>
    <p>© 2025 <strong>BAMX</strong> | Nexunity Labs</p>
  </footer>

  <script>
  const images = [
    "{{ asset('img/bamx1.jpg') }}",
    "{{ asset('img/bamx2.jpg') }}",
    "{{ asset('img/bamx3.jpg') }}",
    "{{ asset('img/bamx4.jpg') }}"
  ];

  let index = 0;
  const slider = document.getElementById('slider');

  setInterval(() => {
    slider.style.opacity = 0;

    setTimeout(() => {
      index = (index + 1) % images.length;
      slider.src = images[index];
      slider.style.opacity = 1;
    }, 1200);
  }, 5000);
</script>


</body>
</html>


         