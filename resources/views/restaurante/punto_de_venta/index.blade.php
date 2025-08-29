<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta - Restaurante</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
    }

    .menu-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .category-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
    }

    .category-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
      border: 2px solid #3b82f6;
    }

    .category-card.active {
      border: 2px solid #3b82f6;
      background: rgba(59, 130, 246, 0.1);
    }

    .product-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      cursor: pointer;
      border: 2px solid transparent;
    }

    .product-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
      border: 2px solid #3b82f6;
    }

    .cart-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      max-height: 70vh;
      overflow-y: auto;
    }

    .search-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    .cart-item {
      background: rgba(249, 250, 251, 0.8);
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .cart-item:hover {
      background: rgba(239, 246, 255, 0.8);
    }

    .category-colors {
      --platos: linear-gradient(135deg, #3b82f6, #1d4ed8);
      --entradas: linear-gradient(135deg, #10b981, #047857);
      --bebidas: linear-gradient(135deg, #8b5cf6, #7c3aed);
      --alcoholicas: linear-gradient(135deg, #ef4444, #dc2626);
      --ensaladas: linear-gradient(135deg, #f59e0b, #d97706);
      --calientes: linear-gradient(135deg, #f97316, #ea580c);
      --postres: linear-gradient(135deg, #ec4899, #db2777);
    }

    .precio-tag {
      background: linear-gradient(135deg, #059669, #047857);
      color: white;
      padding: 4px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .scrollbar-hide {
      scrollbar-width: none;
      -ms-overflow-style: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
      display: none;
    }

    /* Estilos para el sidebar de categorías */
    .categories-sidebar {
      position: sticky;
      top: 2rem;
      height: fit-content;
    }

    /* Estilos para el carrito lateral */
    .cart-sidebar {
      position: sticky;
      top: 2rem;
      height: fit-content;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen py-4 px-4">

  <!-- Botón Atrás -->
  <div class="absolute top-3 left-3 z-50">
    <a href="http://127.0.0.1:8000/dashboard"
       class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
      <i class="ri-arrow-left-line"></i>
      Atrás
    </a>
  </div>

  <!-- Botón Pantalla Completa -->
  <div class="absolute top-3 right-3 z-50">
    <button id="fullscreenBtn"
            class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-all transform hover:scale-110">
      <i id="fullscreenIcon" class="ri-fullscreen-line text-xl"></i>
    </button>
  </div>

  <!-- Contenedor Principal -->
  <div class="w-full h-full flex-1 mt-10 px-2">

    <!-- Encabezado (más arriba) -->
    <div class="text-center mb-2">
      <h1 class="text-3xl font-bold text-gray-800 mb-1">Punto de Venta</h1>
      <p class="text-gray-600 text-sm">Sistema de ventas para restaurante</p>
    </div>

    <div class="grid grid-cols-12 gap-3 h-full">

      <!-- Sidebar de Categorías (2 columnas - extrema izquierda) -->
      <div class="col-span-2">
        <div class="categories-sidebar h-full">
          <div class="menu-card p-3 h-full">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 text-center">
              <i class="ri-list-check text-blue-600 mr-1"></i>
              Categorías
            </h3>
            <div class="space-y-2" id="categoriesGrid">
              <!-- Categorías dinámicas -->
            </div>
          </div>
        </div>
      </div>

      <!-- Panel de Productos (8 columnas - centro) -->
      <div class="col-span-8 space-y-3">

        <!-- Barra de Búsqueda y Filtros -->
        <div class="menu-card p-3">
          <div class="flex flex-col md:flex-row gap-2 items-center">
            <!-- Búsqueda -->
            <div class="relative flex-1">
              <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
              <input type="text" id="searchInput" placeholder="Buscar productos o categorías..."
                     class="search-input w-full border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition">
            </div>
            <!-- Botón Agregar Cliente -->
            <button class="px-3 py-2.5 bg-gradient-to-r from-green-600 to-emerald-700 text-white font-medium rounded-xl shadow hover:from-green-700 hover:to-emerald-800 transition-all flex items-center gap-2 text-sm">
              <i class="ri-user-add-line"></i>
              Agregar cliente
            </button>
          </div>
        </div>

        <!-- Productos -->
        <div class="menu-card p-3 flex-1">
          <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-semibold text-gray-800">
              <i class="ri-restaurant-line text-blue-600 mr-1"></i>
              Productos Disponibles
            </h3>
            <span id="productCount" class="text-sm text-gray-600 bg-blue-50 px-2 py-1 rounded-full"></span>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-3" id="productsGrid">
            <!-- Productos dinámicos -->
          </div>
        </div>

      </div>

      <!-- Panel del Carrito (2 columnas - extrema derecha) -->
      <div class="col-span-2">
        <div class="cart-sidebar h-full">
          <div class="cart-card p-3 h-full flex flex-col">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2 justify-center">
              <i class="ri-shopping-cart-line text-blue-600"></i>
              Carrito de Compras
            </h3>

            <!-- Items del Carrito -->
            <div class="flex-1 space-y-2 mb-3 scrollbar-hide overflow-y-auto" id="cartItems">
              <div class="text-center text-gray-500 py-6" id="emptyCart">
                <i class="ri-shopping-cart-line text-3xl mb-1"></i>
                <p class="font-semibold text-sm">Tu carrito está vacío</p>
                <p class="text-xs">Agrega productos para comenzar</p>
              </div>
            </div>

            <!-- Resumen del Carrito -->
            <div class="border-t pt-3 space-y-2" id="cartSummary" style="display: none;">
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">Subtotal:</span>
                <span class="font-semibold" id="subtotal">S/ 0.00</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">I.G.V (18%):</span>
                <span class="font-semibold" id="igv">S/ 0.00</span>
              </div>
              <div class="flex justify-between text-base font-bold border-t pt-2">
                <span>Total:</span>
                <span class="text-blue-600" id="total">S/ 0.00</span>
              </div>
            </div>

            <!-- Botones de Acción -->
            <div class="space-y-2 mt-3">
              <button id="saveOrderBtn" class="w-full py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl shadow hover:from-gray-700 hover:to-gray-800 transition-all flex items-center justify-center gap-2 text-sm" disabled>
                <i class="ri-save-line"></i>
                Guardar cuenta
              </button>
              <button id="processOrderBtn" class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-semibold rounded-xl shadow hover:from-blue-700 hover:to-indigo-800 transition-all flex items-center justify-center gap-2 text-sm" disabled>
                <i class="ri-cash-line"></i>
                Procesar venta
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    // Funcionalidad pantalla completa
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

    // Datos de productos
    const products = [
      { id: 1, nombre: "Pollo a la Brasa", categoria: "Platos Principales", precio: 25.00 },
      { id: 2, nombre: "Lomo Saltado", categoria: "Platos Principales", precio: 28.00 },
      { id: 3, nombre: "Ceviche Mixto", categoria: "Entradas", precio: 30.00 },
      { id: 4, nombre: "Inca Kola 500ml", categoria: "Bebidas", precio: 6.00 },
      { id: 5, nombre: "Cerveza Cusqueña", categoria: "Bebidas Alcohólicas", precio: 8.00 },
      { id: 6, nombre: "Pizza Familiar", categoria: "Platos Principales", precio: 40.00 },
      { id: 7, nombre: "Hamburguesa Gourmet", categoria: "Platos Principales", precio: 20.00 },
      { id: 8, nombre: "Ensalada César", categoria: "Ensaladas", precio: 18.00 },
      { id: 9, nombre: "Agua Mineral 500ml", categoria: "Bebidas", precio: 4.00 },
      { id: 10, nombre: "Té Helado", categoria: "Bebidas", precio: 5.00 },
      { id: 11, nombre: "Café Americano", categoria: "Bebidas Calientes", precio: 7.00 },
      { id: 12, nombre: "Tiramisú", categoria: "Postres", precio: 12.00 },
      { id: 13, nombre: "Churros con Chocolate", categoria: "Postres", precio: 10.00 },
      { id: 14, nombre: "Jugo de Frutas Natural", categoria: "Bebidas", precio: 8.00 },
      { id: 15, nombre: "Anticuchos", categoria: "Entradas", precio: 15.00 },
      { id: 16, nombre: "Arroz con Pollo", categoria: "Platos Principales", precio: 22.00 },
      { id: 17, nombre: "Pisco Sour", categoria: "Bebidas Alcohólicas", precio: 15.00 },
      { id: 18, nombre: "Tacu Tacu", categoria: "Platos Principales", precio: 26.00 },
      { id: 19, nombre: "Chicha Morada", categoria: "Bebidas", precio: 6.00 },
      { id: 20, nombre: "Suspiro Limeño", categoria: "Postres", precio: 14.00 }
    ];

    // Variables globales
    let cart = [];
    let selectedCategory = 'Todos';
    let filteredProducts = [...products];

    // Elementos DOM
    const categoriesGrid = document.getElementById('categoriesGrid');
    const productsGrid = document.getElementById('productsGrid');
    const cartItems = document.getElementById('cartItems');
    const emptyCart = document.getElementById('emptyCart');
    const cartSummary = document.getElementById('cartSummary');
    const searchInput = document.getElementById('searchInput');
    const productCount = document.getElementById('productCount');
    const saveOrderBtn = document.getElementById('saveOrderBtn');
    const processOrderBtn = document.getElementById('processOrderBtn');

    // Obtener categorías únicas
    const categories = ['Todos', ...new Set(products.map(p => p.categoria))];

    // Colores para categorías
    const categoryColors = {
      'Todos': 'from-gray-600 to-gray-700',
      'Platos Principales': 'from-blue-600 to-blue-700',
      'Entradas': 'from-green-600 to-green-700',
      'Bebidas': 'from-purple-600 to-purple-700',
      'Bebidas Alcohólicas': 'from-red-600 to-red-700',
      'Ensaladas': 'from-yellow-600 to-yellow-700',
      'Bebidas Calientes': 'from-orange-600 to-orange-700',
      'Postres': 'from-pink-600 to-pink-700'
    };

    // Íconos para categorías
    const categoryIcons = {
      'Todos': 'ri-grid-line',
      'Platos Principales': 'ri-restaurant-line',
      'Entradas': 'ri-bowl-line',
      'Bebidas': 'ri-cup-line',
      'Bebidas Alcohólicas': 'ri-wine-bottle-line',
      'Ensaladas': 'ri-plant-line',
      'Bebidas Calientes': 'ri-fire-line',
      'Postres': 'ri-cake-3-line'
    };

    // Renderizar categorías
    function renderCategories() {
      categoriesGrid.innerHTML = categories.map(cat => `
        <div class="category-card p-3 flex items-center gap-3 ${selectedCategory === cat ? 'active' : ''}"
             onclick="selectCategory('${cat}')">
          <div class="w-10 h-10 bg-gradient-to-r ${categoryColors[cat] || 'from-gray-600 to-gray-700'} rounded-full flex items-center justify-center flex-shrink-0">
            <i class="${categoryIcons[cat] || 'ri-restaurant-line'} text-white text-lg"></i>
          </div>
          <span class="text-sm font-semibold text-gray-700">${cat}</span>
        </div>
      `).join('');
    }

    // Renderizar productos
    function renderProducts() {
      const productsToShow = selectedCategory === 'Todos'
        ? filteredProducts
        : filteredProducts.filter(p => p.categoria === selectedCategory);

      productCount.textContent = `${productsToShow.length} productos encontrados`;

      productsGrid.innerHTML = productsToShow.map(product => `
        <div class="product-card p-4" onclick="addToCart(${product.id})">
          <div class="flex justify-between items-start mb-3">
            <h4 class="font-semibold text-gray-800 text-sm leading-tight flex-1 pr-2">${product.nombre}</h4>
            <span class="precio-tag text-xs">S/ ${product.precio.toFixed(2)}</span>
          </div>
          <p class="text-xs text-gray-600 mb-3">${product.categoria}</p>
          <div class="w-full h-20 bg-gradient-to-r ${categoryColors[product.categoria] || 'from-gray-400 to-gray-500'} rounded-lg flex items-center justify-center mb-3">
            <i class="${categoryIcons[product.categoria] || 'ri-restaurant-line'} text-white text-2xl"></i>
          </div>
          <button class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-all transform hover:scale-105">
            <i class="ri-add-line mr-1"></i>
            Agregar al carrito
          </button>
        </div>
      `).join('');
    }

    // Seleccionar categoría
    function selectCategory(category) {
      selectedCategory = category;
      renderCategories();
      renderProducts();
    }

    // Agregar al carrito
    function addToCart(productId) {
      const product = products.find(p => p.id === productId);
      const existingItem = cart.find(item => item.id === productId);

      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({ ...product, quantity: 1 });
      }

      renderCart();
      updateCartSummary();
    }

    // Renderizar carrito
    function renderCart() {
      if (cart.length === 0) {
        emptyCart.style.display = 'block';
        cartSummary.style.display = 'none';
        saveOrderBtn.disabled = true;
        processOrderBtn.disabled = true;
        cartItems.innerHTML = '<div class="text-center text-gray-500 py-6" id="emptyCart"><i class="ri-shopping-cart-line text-4xl mb-2"></i><p class="font-semibold text-sm">Tu carrito está vacío</p><p class="text-xs">Agrega productos para comenzar</p></div>';
        return;
      }

      emptyCart.style.display = 'none';
      cartSummary.style.display = 'block';
      saveOrderBtn.disabled = false;
      processOrderBtn.disabled = false;

      cartItems.innerHTML = cart.map(item => `
        <div class="cart-item p-3">
          <div class="flex justify-between items-start mb-2">
            <h5 class="font-semibold text-sm text-gray-800 flex-1 pr-2">${item.nombre}</h5>
            <button onclick="removeFromCart(${item.id})" class="text-red-500 hover:text-red-700 p-1">
              <i class="ri-close-line text-base"></i>
            </button>
          </div>
          <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
              <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})"
                      class="w-7 h-7 bg-gray-300 rounded-full text-xs hover:bg-gray-400 flex items-center justify-center transition">
                <i class="ri-subtract-line"></i>
              </button>
              <span class="text-sm font-semibold min-w-[1.5rem] text-center">${item.quantity}</span>
              <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})"
                      class="w-7 h-7 bg-blue-600 text-white rounded-full text-xs hover:bg-blue-700 flex items-center justify-center transition">
                <i class="ri-add-line"></i>
              </button>
            </div>
            <span class="font-bold text-blue-600 text-sm">S/ ${(item.precio * item.quantity).toFixed(2)}</span>
          </div>
        </div>
      `).join('');
    }

    // Actualizar cantidad
    function updateQuantity(productId, newQuantity) {
      if (newQuantity <= 0) {
        removeFromCart(productId);
        return;
      }

      const item = cart.find(item => item.id === productId);
      if (item) {
        item.quantity = newQuantity;
        renderCart();
        updateCartSummary();
      }
    }

    // Remover del carrito
    function removeFromCart(productId) {
      cart = cart.filter(item => item.id !== productId);
      renderCart();
      updateCartSummary();
    }

    // Actualizar resumen del carrito
    function updateCartSummary() {
      const subtotal = cart.reduce((sum, item) => sum + (item.precio * item.quantity), 0);
      const igv = subtotal * 0.18;
      const total = subtotal + igv;

      document.getElementById('subtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
      document.getElementById('igv').textContent = `S/ ${igv.toFixed(2)}`;
      document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;
    }

    // Filtrar productos por búsqueda
    function filterProducts() {
      const searchTerm = searchInput.value.toLowerCase();
      filteredProducts = products.filter(product =>
        product.nombre.toLowerCase().includes(searchTerm) ||
        product.categoria.toLowerCase().includes(searchTerm)
      );
      renderProducts();
    }

    // Event listeners
    searchInput.addEventListener('input', filterProducts);

    saveOrderBtn.addEventListener('click', () => {
      alert('Cuenta guardada exitosamente');
    });

    processOrderBtn.addEventListener('click', () => {
      if (cart.length > 0) {
        alert(`Venta procesada por S/ ${document.getElementById('total').textContent}`);
        cart = [];
        renderCart();
        updateCartSummary();
      }
    });

    // Inicializar
    renderCategories();
    renderProducts();
    renderCart();
  </script>
</body>
</html>
