<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
         <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
  max-width: 100%;
  border-radius: 12px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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


</style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            @stack('scripts')
        </div>
    </body>
</html>
