<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Restaurante</title>
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

    .dish-row:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .category-badge {
      padding: 3px 10px;
      border-radius: 16px;
      font-size: 0.7rem;
      font-weight: 500;
    }

    .search-input:focus {
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    /* Estilos para tabla más compacta */
    .compact-table th {
      padding: 0.5rem 0.75rem;
      font-size: 0.8rem;
    }

    .compact-table td {
      padding: 0.5rem 0.75rem;
      font-size: 0.9rem;
    }

    /* Estilos para paginación numérica */
    .pagination-btn {
      min-width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .pagination-btn:hover:not(.disabled):not(.active) {
      background: rgba(59, 130, 246, 0.1);
      color: #3b82f6;
      transform: translateY(-1px);
    }

    .pagination-btn.active {
      background: linear-gradient(135deg, #3b82f6, #6366f1);
      color: white;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
      transform: translateY(-1px);
    }

    .pagination-btn.disabled {
      opacity: 0.4;
      cursor: not-allowed;
    }

    .pagination-ellipsis {
      color: #9ca3af;
      font-weight: 500;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen py-6 px-4">

  <!-- Botón Atrás -->
  <div class="absolute top-3 left-3">
    <a href="http://127.0.0.1:8000/dashboard"
       class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-xl shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-1">
      <i class="ri-arrow-left-line"></i>
      Atrás
    </a>
  </div>

  <!-- Botón Pantalla Completa -->
  <div class="absolute top-3 right-3">
    <button id="fullscreenBtn"
            class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-all transform hover:scale-110">
      <i id="fullscreenIcon" class="ri-fullscreen-line text-xl"></i>
    </button>
  </div>

  <!-- Contenedor Principal -->
  <div class="container mx-auto max-w-6xl flex-1 mt-12">

    <!-- Encabezado -->
    <div class="text-center mb-6">
      <h1 class="text-4xl font-bold text-gray-800 mb-2">Menú del Restaurante</h1>
      <p class="text-gray-600">Explora nuestra deliciosa selección de platos y bebidas</p>
    </div>

    <!-- Contenedor Tabla -->
    <div class="menu-card p-5 md:p-6">

      <!-- Barra Superior -->
      <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <!-- Botón Registrar -->
        <button class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-medium rounded-xl shadow hover:from-blue-700 hover:to-indigo-800 transition-all flex items-center gap-2 text-sm">
          <i class="ri-add-circle-line"></i>
          Nuevo Producto
        </button>

        <!-- Buscador y Selector -->
        <div class="flex flex-col md:flex-row gap-3 items-center w-full md:w-auto">
          <div class="relative w-full md:w-60">
            <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" id="search" placeholder="Buscar plato o bebida..."
                   class="search-input w-full border border-gray-300 rounded-xl pl-9 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none transition text-sm">
          </div>
          <select id="rowsPerPage"
                  class="border border-gray-300 rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:outline-none text-sm">
            <option value="5">5 filas</option>
            <option value="10" selected>10 filas</option>
            <option value="20">20 filas</option>
          </select>
        </div>
      </div>

      <!-- Tabla -->
      <div class="overflow-x-auto rounded-2xl shadow-inner">
        <table class="w-full border-collapse compact-table">
          <thead>
            <tr class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white text-left">
              <th class="font-semibold uppercase">ID</th>
              <th class="font-semibold uppercase">Nombre</th>
              <th class="font-semibold uppercase">Categoría</th>
              <th class="font-semibold uppercase text-right">Precio</th>
            </tr>
          </thead>
          <tbody id="tableBody" class="divide-y divide-gray-100">
            <!-- Datos dinámicos -->
          </tbody>
        </table>

        <!-- Estado vacío -->
        <div id="emptyState" class="hidden py-10 text-center">
          <i class="ri-search-eye-line text-3xl text-gray-300 mb-3"></i>
          <p class="text-gray-500 text-sm">No se encontraron resultados para tu búsqueda</p>
        </div>
      </div>

      <!-- Paginación Mejorada -->
      <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
        <div class="flex items-center gap-4">
          <p id="paginationInfo" class="text-sm text-gray-600"></p>
          <div class="text-sm text-gray-500">
            Total de páginas: <span id="totalPages" class="font-semibold text-blue-600"></span>
          </div>
        </div>

        <div id="paginationContainer" class="flex items-center gap-1">
          <!-- Los botones de paginación se generarán aquí -->
        </div>
      </div>
    </div>
  </div>

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

    // Data de prueba
    const data = [
      { id: 1, nombre: "Pollo a la Brasa", categoria: "Platos Principales", precio: "25.00" },
      { id: 2, nombre: "Lomo Saltado", categoria: "Platos Principales", precio: "28.00" },
      { id: 3, nombre: "Ceviche Mixto", categoria: "Entradas", precio: "30.00" },
      { id: 4, nombre: "Inca Kola 500ml", categoria: "Bebidas", precio: "6.00" },
      { id: 5, nombre: "Cerveza Cusqueña", categoria: "Bebidas Alcohólicas", precio: "8.00" },
      { id: 6, nombre: "Pizza Familiar", categoria: "Platos Principales", precio: "40.00" },
      { id: 7, nombre: "Hamburguesa Gourmet", categoria: "Platos Principales", precio: "20.00" },
      { id: 8, nombre: "Ensalada César", categoria: "Ensaladas", precio: "18.00" },
      { id: 9, nombre: "Agua Mineral 500ml", categoria: "Bebidas", precio: "4.00" },
      { id: 10, nombre: "Té Helado", categoria: "Bebidas", precio: "5.00" },
      { id: 11, nombre: "Café Americano", categoria: "Bebidas Calientes", precio: "7.00" },
      { id: 12, nombre: "Tiramisú", categoria: "Postres", precio: "12.00" },
      { id: 13, nombre: "Churros con Chocolate", categoria: "Postres", precio: "10.00" },
      { id: 14, nombre: "Jugo de Frutas Natural", categoria: "Bebidas", precio: "8.00" },
      { id: 15, nombre: "Anticuchos", categoria: "Entradas", precio: "15.00" },
      { id: 16, nombre: "Arroz con Pollo", categoria: "Platos Principales", precio: "22.00" },
      { id: 17, nombre: "Pisco Sour", categoria: "Bebidas Alcohólicas", precio: "15.00" },
      { id: 18, nombre: "Tacu Tacu", categoria: "Platos Principales", precio: "26.00" },
      { id: 19, nombre: "Chicha Morada", categoria: "Bebidas", precio: "6.00" },
      { id: 20, nombre: "Suspiro Limeño", categoria: "Postres", precio: "14.00" }
    ];

    let currentPage = 1;
    let rowsPerPage = 10;

    const tableBody = document.getElementById("tableBody");
    const emptyState = document.getElementById("emptyState");
    const searchInput = document.getElementById("search");
    const rowsSelect = document.getElementById("rowsPerPage");
    const paginationInfo = document.getElementById("paginationInfo");
    const totalPagesSpan = document.getElementById("totalPages");
    const paginationContainer = document.getElementById("paginationContainer");

    function getCategoryClass(category) {
      const categoryClasses = {
        "Platos Principales": "bg-blue-100 text-blue-800",
        "Entradas": "bg-green-100 text-green-800",
        "Bebidas": "bg-purple-100 text-purple-800",
        "Bebidas Alcohólicas": "bg-red-100 text-red-800",
        "Ensaladas": "bg-yellow-100 text-yellow-800",
        "Bebidas Calientes": "bg-orange-100 text-orange-800",
        "Postres": "bg-pink-100 text-pink-800"
      };
      return categoryClasses[category] || "bg-gray-100 text-gray-800";
    }

    function getFilteredData() {
      const searchText = searchInput.value.toLowerCase();
      return data.filter(item =>
        item.nombre.toLowerCase().includes(searchText) ||
        item.categoria.toLowerCase().includes(searchText) ||
        item.precio.includes(searchText)
      );
    }

    function createPaginationButton(page, text = null, isActive = false, isDisabled = false, icon = null) {
      const button = document.createElement('button');
      button.className = `pagination-btn ${isActive ? 'active' : ''} ${isDisabled ? 'disabled' : 'bg-white border border-gray-300 text-gray-700'}`;

      if (icon) {
        button.innerHTML = `<i class="${icon}"></i>`;
      } else {
        button.textContent = text || page;
      }

      if (!isDisabled) {
        button.onclick = () => goToPage(page);
      }

      return button;
    }

    function renderPagination(filteredData) {
      const totalPages = Math.ceil(filteredData.length / rowsPerPage);
      totalPagesSpan.textContent = totalPages;

      paginationContainer.innerHTML = '';

      if (totalPages <= 1) return;

      // Botón Anterior
      const prevBtn = createPaginationButton(
        currentPage - 1,
        '',
        false,
        currentPage === 1,
        'ri-arrow-left-s-line'
      );
      paginationContainer.appendChild(prevBtn);

      // Lógica de números de página
      let startPage = Math.max(1, currentPage - 2);
      let endPage = Math.min(totalPages, currentPage + 2);

      // Ajustar para mostrar siempre 5 páginas si es posible
      if (endPage - startPage < 4) {
        if (startPage === 1) {
          endPage = Math.min(totalPages, startPage + 4);
        } else if (endPage === totalPages) {
          startPage = Math.max(1, endPage - 4);
        }
      }

      // Primer página y puntos suspensivos
      if (startPage > 1) {
        paginationContainer.appendChild(createPaginationButton(1));
        if (startPage > 2) {
          const ellipsis = document.createElement('span');
          ellipsis.className = 'pagination-ellipsis px-2';
          ellipsis.textContent = '...';
          paginationContainer.appendChild(ellipsis);
        }
      }

      // Páginas numeradas
      for (let i = startPage; i <= endPage; i++) {
        paginationContainer.appendChild(
          createPaginationButton(i, i, i === currentPage)
        );
      }

      // Puntos suspensivos y última página
      if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
          const ellipsis = document.createElement('span');
          ellipsis.className = 'pagination-ellipsis px-2';
          ellipsis.textContent = '...';
          paginationContainer.appendChild(ellipsis);
        }
        paginationContainer.appendChild(createPaginationButton(totalPages));
      }

      // Botón Siguiente
      const nextBtn = createPaginationButton(
        currentPage + 1,
        '',
        false,
        currentPage === totalPages,
        'ri-arrow-right-s-line'
      );
      paginationContainer.appendChild(nextBtn);
    }

    function goToPage(page) {
      const filteredData = getFilteredData();
      const totalPages = Math.ceil(filteredData.length / rowsPerPage);

      if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderTable();
      }
    }

    function renderTable() {
      const filteredData = getFilteredData();
      const start = (currentPage - 1) * rowsPerPage;
      const end = start + rowsPerPage;
      const paginatedData = filteredData.slice(start, end);

      tableBody.innerHTML = "";

      if (paginatedData.length === 0) {
        emptyState.classList.remove('hidden');
        paginationContainer.innerHTML = '';
        totalPagesSpan.textContent = '0';
        paginationInfo.textContent = 'No hay registros para mostrar';
        return;
      } else {
        emptyState.classList.add('hidden');
      }

      paginatedData.forEach(item => {
        const categoryClass = getCategoryClass(item.categoria);
        tableBody.innerHTML += `
          <tr class="dish-row transition-all duration-300 bg-white hover:bg-blue-50">
            <td class="font-medium">${item.id}</td>
            <td>
              <div class="font-semibold">${item.nombre}</div>
            </td>
            <td>
              <span class="category-badge ${categoryClass}">${item.categoria}</span>
            </td>
            <td class="text-right font-bold text-blue-700">S/. ${item.precio}</td>
          </tr>`;
      });

      paginationInfo.textContent = `Mostrando ${start + 1} a ${Math.min(end, filteredData.length)} de ${filteredData.length} registros`;

      renderPagination(filteredData);
    }

    searchInput.addEventListener("input", () => {
      currentPage = 1;
      renderTable();
    });

    rowsSelect.addEventListener("change", () => {
      rowsPerPage = parseInt(rowsSelect.value);
      currentPage = 1;
      renderTable();
    });

    // Inicializar
    rowsSelect.value = rowsPerPage;
    renderTable();
  </script>
</body>
</html>
