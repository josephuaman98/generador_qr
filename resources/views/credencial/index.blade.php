<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Listado de Socios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    :root { --bg:#f6f7fb; --card:#fff; --text:#222; --muted:#6b7280; --line:#e5e7eb; --head:#0d6efd; }
    body {
      margin: 0; padding: 24px; font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      background: var(--bg); color: var(--text);
    }
    .wrap {
      max-width: 1100px; margin: 0 auto; background: var(--card); border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,.06); overflow: hidden;
    }
    .header {
      padding: 20px 24px; background: linear-gradient(90deg, var(--head), #4f46e5);
      color: #fff; display: flex; justify-content: space-between; align-items: center;
    }
    .header-content { flex: 1; }
    .header h1 { margin: 0; font-size: 20px; }
    .sub { margin-top: 4px; font-size: 12px; opacity: .9; }
    
    .actions {
      display: flex; gap: 10px; margin-top: 16px; flex-wrap: wrap;
    }
    .btn {
      padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;
      font-size: 14px; display: flex; align-items: center; gap: 6px;
      transition: all 0.2s ease;
    }
    .btn-primary {
      background: #0d6efd; color: white;
    }
    .btn-primary:hover {
      background: #0b5ed7;
    }
    .btn-outline {
      background: transparent; border: 1px solid #dee2e6; color: #6c757d;
    }
    .btn-outline:hover {
      background: #f8f9fa;
    }
    .btn-pdf {
      background: #dc3545; color: white;
    }
    .btn-pdf:hover {
      background: #c82333;
    }

    .table-wrap { padding: 16px 24px 24px; overflow: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 860px; }
    thead th {
      text-align: left; font-weight: 600; font-size: 13px; letter-spacing: .02em;
      padding: 12px 10px; background: #f3f4f6; border-bottom: 1px solid var(--line);
      white-space: nowrap;
    }
    tbody td {
      padding: 12px 10px; border-bottom: 1px solid var(--line); font-size: 14px;
    }
    tbody tr:hover { background: #fafafa; }
    .muted { color: var(--muted); }
    .badge {
      display: inline-block; padding: 4px 8px; border-radius: 999px; font-size: 12px;
      background: #eef2ff;
    }
    .checkbox-cell { width: 40px; text-align: center; }
    .select-all-container { display: flex; align-items: center; gap: 8px; }
    .selected-count {
      background: #0d6efd; color: white; padding: 2px 8px; border-radius: 12px;
      font-size: 12px; margin-left: 8px;
    }
  </style>

</head>
<body>
  <div class="wrap">
    <div class="header">
      <div class="header-content">
        <h1>Listado de Socios</h1>
      </div>
      <div id="selected-count" class="selected-count" style="display: none;">0</div>
    </div>

    <div class="actions">
      <button class="btn btn-primary" id="btn-selected">
        <i class="bi bi-check2-square"></i> Procesar seleccionados
      </button>
      <button class="btn btn-pdf" id="btn-pdf">
        <i class="bi bi-file-earmark-pdf"></i> Generar Carnets (PDF)
      </button>
      <button class="btn btn-outline" id="btn-select-all">
        <i class="bi bi-check2-all"></i> Seleccionar todos
      </button>
      <button class="btn btn-outline" id="btn-deselect-all">
        <i class="bi bi-x-square"></i> Deseleccionar todos
      </button>
    </div>

    <div class="table-wrap">
      <table id="tabla-socios" class="display" style="width:100%">
        <thead>
          <tr>
            <th class="checkbox-cell">
              <div class="select-all-container">
                <input type="checkbox" id="select-all">
              </div>
            </th>
            <th>ID Socio</th>
            <th>Código</th>
            <th>Nombres</th>
            <th>Documento</th>
            <th>Sexo</th>
            <th>Giro</th>
            <th>Sub Giro</th>
            <th>QR (Temporal)</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($socios as $socio)
            <tr>
              <td class="checkbox-cell">
                <input type="checkbox" class="row-checkbox" data-id="{{ $socio->id_socio }}">
              </td>
              <td>{{ $socio->id_socio }}</td>
              <td><span class="muted">{{ $socio->codigo }}</span></td>
              <td>{{ $socio->nombres }}</td>
              <td>{{ $socio->documento }}</td>
              <td><span class="badge">{{ $socio->sexo }}</span></td>
              <td>{{ $socio->nom_giro }}</td>
              <td>{{ $socio->nom_sub_giro }}</td>
              <td>
                <!-- Mostrar el QR que ya generamos en el controlador -->
                <img src="data:image/png;base64,{{ $socio->qr_base64 }}" alt="QR Code" width="100">
            </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align:center; color:gray;">
                No se encontraron registros
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  
<script>
    $(document).ready(function() {
        var table = $('#tabla-socios').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
            },
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: true,
            searching: true,
            columnDefs: [
                { orderable: false, targets: 0 }
            ]
        });

        const selectAllCheckbox = $('#select-all');
        const selectedCount = $('#selected-count');
        const selectAllBtn = $('#btn-select-all');
        const deselectAllBtn = $('#btn-deselect-all');

        // 🔹 Objeto para guardar seleccionados
        let selectedSocios = {};

        function updateSelectedCount() {
            const total = Object.keys(selectedSocios).length;
            if (total > 0) {
                selectedCount.text(total).show();
            } else {
                selectedCount.hide();
            }
        }

        // Cuando cambie un checkbox en cualquier página
        $(document).on('change', '.row-checkbox', function() {
            const row = $(this).closest('tr');
            const codigo = row.find('td:eq(2)').text().trim();
            const qrImage = row.find('td:eq(8) img').attr('src'); // 👈 Captura el 'src' de la imagen QR

            if ($(this).is(':checked')) {
                selectedSocios[codigo] = {
                    codigo: codigo,
                    nombres: row.find('td:eq(3)').text(),
                    documento: row.find('td:eq(4)').text(),
                    nom_giro: row.find('td:eq(6)').text(),
                    nom_sub_giro: row.find('td:eq(7)').text(),
                    qrData: qrImage // 👈 Guarda el 'src' de la imagen
                };
            } else {
                delete selectedSocios[codigo];
            }
            updateSelectedCount();
        });

        // Seleccionar todo (solo en la página actual)
        selectAllCheckbox.on('change', function() {
            const isChecked = $(this).prop('checked');
            $('#tabla-socios tbody .row-checkbox').prop('checked', isChecked).trigger('change');
        });

        // Botones extra
        selectAllBtn.on('click', function() {
            $('#tabla-socios tbody .row-checkbox').prop('checked', true).trigger('change');
        });

        deselectAllBtn.on('click', function() {
            $('#tabla-socios tbody .row-checkbox').prop('checked', false).trigger('change');
        });

        // Guardamos la variable en el DOM global
        window.selectedSocios = selectedSocios;

        updateSelectedCount();
    });
</script>


<script>
    $(document).ready(function() {
        $('#btn-pdf').on('click', function() {
            const selectedRowsData = Object.values(window.selectedSocios || {});

            if (!selectedRowsData.length) {
                alert('Por favor, seleccione al menos un socio para generar el PDF.');
                return;
            }

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ unit: 'mm', format: 'a4', orientation: 'landscape' });

            // 📏 Constantes de medida
            const pageW = doc.internal.pageSize.getWidth();
            const pageH = doc.internal.pageSize.getHeight();
            const dniW = 46.98, dniH = 78.60;
            const extra = 12; // Margen interno del carnet
            const cardW = dniW + extra, cardH = dniH + extra;
            const lineSpacing = 5;

            // 📦 Espaciado y centrado
            const gap = 7; // Espacio entre tarjetas (7mm)
            
            const pairWidth = (cardW * 2) + gap;
            const pairHeight = cardH;

            const totalGridWidth = (pairWidth * 2) + gap;
            const totalGridHeight = (pairHeight * 2) + gap;
            
            const marginX = (pageW - totalGridWidth) / 2;
            const marginY = (pageH - totalGridHeight) / 2;

            // 🖍 Frente - Diseño Moderno
            function drawCardFront(socio, x, y) {
                doc.setDrawColor(255, 0, 0).setLineWidth(0.5);
                doc.rect(x, y, cardW, cardH); // Borde rojo

                const cardInnerX = x + extra / 2;
                const cardInnerY = y + extra / 2;
                const innerWidth = dniW;

                // Sección del encabezado
                doc.setFillColor(0, 102, 204).rect(cardInnerX, cardInnerY, innerWidth, 15, 'F');
                doc.setFontSize(10).setTextColor(255, 255, 255);
                doc.text("CARNET IDENTIFICACION", cardInnerX + innerWidth / 2, cardInnerY + 8, { align: 'center' });

                // Espacio para la foto (rectángulo con borde redondeado)
                const photoSize = 25;
                const photoX = cardInnerX + (innerWidth - photoSize) / 2;
                const photoY = cardInnerY + 20;
                doc.setDrawColor(200, 200, 200).setLineWidth(0.5).roundedRect(photoX, photoY, photoSize, photoSize, 3, 3);
                doc.setFontSize(8).setTextColor(150, 150, 150).text("FOTO", photoX + photoSize/2, photoY + photoSize/2, { align: 'center' });
                
                // Información del socio
                doc.setFontSize(14).setTextColor(0, 0, 0);
                const nameWrapped = doc.splitTextToSize(socio.nombres, innerWidth - 10);
                let posY = cardInnerY + 55;
                doc.text(nameWrapped, cardInnerX + innerWidth / 2, posY, { align: 'center' });
                
                posY += nameWrapped.length * 6;
                doc.setFontSize(10).setTextColor(100, 100, 100).text("DOCUMENTO", cardInnerX + innerWidth / 2, posY, { align: 'center' });

                posY += 5;
                doc.setFontSize(12).setTextColor(0, 0, 0);
                doc.text(socio.documento, cardInnerX + innerWidth / 2, posY, { align: 'center' });
            }

            // 🖍 Reverso
            function drawCardBack(socio, x, y) {
                doc.setDrawColor(255, 0, 0).setLineWidth(0.5);
                doc.rect(x, y, cardW, cardH); // Borde rojo

                const cardInnerX = x + extra / 2;
                const cardInnerY = y + extra / 2;
                const innerWidth = dniW;

                // Sección del encabezado del reverso
                doc.setFillColor(30, 30, 30).rect(cardInnerX, cardInnerY, innerWidth, 15, 'F');
                doc.setFontSize(10).setTextColor(255, 255, 255);
                doc.text("INFORMACIÓN ADICIONAL", cardInnerX + innerWidth / 2, cardInnerY + 8, { align: 'center' });

                // Beneficios
                doc.setFontSize(8).setTextColor(0, 0, 0);
                let posY = cardInnerY + 25;
                doc.text("BENEFICIOS:", cardInnerX + 5, posY);
                doc.text("- Descuentos en proveedores", cardInnerX + 5, posY += lineSpacing);
                doc.text("- Capacitaciones gratuitas", cardInnerX + 5, posY += lineSpacing);
                doc.text("- Asesoría legal", cardInnerX + 5, posY + lineSpacing);
                
                // 🆕 Agregar el QR en el reverso
                if (socio.qrData) {
                    const qrSize = 30; // Tamaño del QR
                    const qrX = cardInnerX + (innerWidth - qrSize) / 2;
                    const qrY = cardInnerY + 45;
                    doc.addImage(socio.qrData, 'PNG', qrX, qrY, qrSize, qrSize);
                }
            }

            // 🧩 Renderizar carnets
            selectedRowsData.forEach((socio, index) => {
                if (index > 0 && index % 4 === 0) doc.addPage();

                const rowIndex = Math.floor((index % 4) / 2);
                const colIndex = index % 2;

                const xFront = marginX + colIndex * (pairWidth + gap);
                const y = marginY + rowIndex * (pairHeight + gap);
                const xBack = xFront + cardW + gap;

                drawCardFront(socio, xFront, y);
                drawCardBack(socio, xBack, y); // 👈 Pasa el objeto 'socio' a esta función
            });

            doc.save('carnets_socios.pdf');
        });
    });
</script>
  
</body>
</html>