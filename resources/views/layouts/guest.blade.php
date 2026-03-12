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
    <style>
    html, body {
  height: 100%;
  margin: 0;
}

#normal {
 max-width: 400px;
  margin: 60px auto;
  padding: 30px 40px;
  background: rgba(241, 98, 9, 0.47);
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(232, 103, 25, 0.2);
  text-align: center;
}
    </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body >
        <div  id="normal" style="text-align: center; align-items: center;">
            <div class="container">
                
                <a href="/">
                    <x-application-logo style="text-align: center; align-items: center;"/>
                </a>
            

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
