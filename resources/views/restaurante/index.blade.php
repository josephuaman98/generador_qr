<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Restaurante</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

  <!-- Botón Atrás -->
  <div class="absolute top-3 left-3">
    <a href="http://127.0.0.1:8000/dashboard"
       class="flex items-center gap-2 bg-gray-800 text-white px-3 py-2 md:px-4 md:py-2 rounded-xl shadow-lg hover:bg-gray-700 transition text-sm md:text-base">
      <i class="ri-arrow-left-line"></i>
      Atrás
    </a>
  </div>

  <!-- Botón Pantalla Completa -->
  <div class="absolute top-3 right-3">
    <button id="fullscreenBtn"
            class="flex items-center gap-2 bg-gray-800 text-white px-3 py-2 md:px-4 md:py-2 rounded-xl shadow-lg hover:bg-gray-700 transition text-sm md:text-base">
      <i id="fullscreenIcon" class="ri-fullscreen-line text-lg md:text-xl"></i>
    </button>
  </div>

  <!-- Contenedor Principal -->
  <div class="flex flex-col items-center justify-center flex-1 px-4">

    <!-- Título -->
    <header class="mb-10 text-center">
      <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-800 tracking-wide drop-shadow-md">
        Restaurante
      </h1>
      <p class="text-gray-500 mt-1 sm:mt-2 text-sm sm:text-base md:text-lg">Sistema de gestión</p>
    </header>

    <!-- Botones -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 w-full max-w-3xl">

      <!-- INICIO -->
      <a href="{{ route('restaurante.punto_de_venta.index') }}"
         class="flex flex-col items-center justify-center bg-white shadow-xl rounded-2xl p-6 sm:p-8 md:p-10 hover:scale-105 hover:shadow-2xl transition transform">
        <i class="ri-home-5-line text-4xl sm:text-5xl text-blue-600 mb-3"></i>
        <span class="text-base sm:text-lg font-semibold text-gray-700">INICIO</span>
      </a>

      <!-- PRODUCTOS -->
      <a href="#"
         class="flex flex-col items-center justify-center bg-white shadow-xl rounded-2xl p-6 sm:p-8 md:p-10 hover:scale-105 hover:shadow-2xl transition transform">
        <i class="ri-restaurant-2-line text-4xl sm:text-5xl text-green-600 mb-3"></i>
        <span class="text-base sm:text-lg font-semibold text-gray-700">PRODUCTOS</span>
      </a>

      <!-- INVENTARIO -->
      <a href="#"
         class="flex flex-col items-center justify-center bg-white shadow-xl rounded-2xl p-6 sm:p-8 md:p-10 hover:scale-105 hover:shadow-2xl transition transform">
        <i class="ri-database-2-line text-4xl sm:text-5xl text-yellow-500 mb-3"></i>
        <span class="text-base sm:text-lg font-semibold text-gray-700">INVENTARIO</span>
      </a>

      <!-- PUNTO DE VENTA -->
      <a href="{{ route('restaurante.punto_de_venta.index') }}"
         class="flex flex-col items-center justify-center bg-white shadow-xl rounded-2xl p-6 sm:p-8 md:p-10 hover:scale-105 hover:shadow-2xl transition transform">
        <i class="ri-shopping-cart-2-line text-4xl sm:text-5xl text-red-500 mb-3"></i>
        <span class="text-base sm:text-lg font-semibold text-gray-700">PUNTO DE VENTA</span>
      </a>

    </div>
  </div>

  <!-- Script Pantalla Completa -->
  <script>
    const fullscreenBtn = document.getElementById("fullscreenBtn");
    const fullscreenIcon = document.getElementById("fullscreenIcon");

    fullscreenBtn.addEventListener("click", () => {
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
        fullscreenIcon.classList.replace("ri-fullscreen-line", "ri-fullscreen-exit-line");
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
          fullscreenIcon.classList.replace("ri-fullscreen-exit-line", "ri-fullscreen-line");
        }
      }
    });
  </script>

</body>
</html>
