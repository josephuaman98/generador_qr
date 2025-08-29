<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Socio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }

        .credential-card {
            width: 400px;
            height: 600px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .header {
            background: linear-gradient(to right, #1a3a8f, #2c5cc5);
            color: white;
            padding: 25px 20px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.9;
        }

        .logo {
            position: absolute;
            top: 15px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: #1a3a8f;
            font-size: 12px;
        }

        .content {
            padding: 25px;
        }

        .photo-section {
            display: flex;
            margin-bottom: 25px;
        }

        .photo-container {
            width: 130px;
            height: 160px;
            border: 2px solid #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
            background: #f9f9f9;
        }

        .photo-placeholder {
            color: #888;
            font-size: 12px;
            text-align: center;
            padding: 10px;
        }

        .details {
            flex: 1;
        }

        .detail-item {
            margin-bottom: 12px;
        }

        .detail-label {
            font-size: 10px;
            color: #777;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .detail-value {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .section {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .section-title {
            font-size: 12px;
            color: #1a3a8f;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .legal-text {
            font-size: 9px;
            color: #666;
            line-height: 1.4;
            text-align: justify;
        }

        .resolution-data {
            background: #f8f9fc;
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .resolution-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .resolution-label {
            font-size: 10px;
            color: #777;
        }

        .resolution-value {
            font-size: 10px;
            color: #333;
            font-weight: 500;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 15px;
            text-align: center;
            background: #f8f9fc;
            font-size: 9px;
            color: #888;
        }

        .watermark {
            position: absolute;
            bottom: 80px;
            right: 20px;
            opacity: 0.1;
            font-size: 60px;
            font-weight: bold;
            color: #1a3a8f;
            transform: rotate(-30deg);
            user-select: none;
        }

        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature {
            width: 45%;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }

        .barcode {
            text-align: center;
            margin-top: 15px;
            padding: 5px;
            background: #f0f0f0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="credential-card">
        <div class="header">
            <h1>CREDENCIAL OFICIAL</h1>
            <h2>ASOCIACIÓN DE COMERCIANTES</h2>
            <div class="logo">AC</div>
        </div>

        <div class="content">
            <div class="photo-section">
                <div class="photo-container">
                    <div class="photo-placeholder">Fotografía 3x4</div>
                </div>
                <div class="details">
                    <div class="detail-item">
                        <div class="detail-label">ID Socio</div>
                        <div class="detail-value">{{ $socio->id_socio }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Código</div>
                        <div class="detail-value">{{ $socio->codigo }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Nombre</div>
                        <div class="detail-value">{{ $socio->nombres }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Documento</div>
                        <div class="detail-value">{{ $socio->documento }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Sexo</div>
                        <div class="detail-value">{{ $socio->sexo }}</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Información de Asociación</div>
                <div class="resolution-data">
                    <div class="resolution-item">
                        <span class="resolution-label">Asociación:</span>
                        <span class="resolution-value">{{ $socio->nombre_asociacion }}</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Giro:</span>
                        <span class="resolution-value">{{ $socio->nom_giro }}</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Sub Giro:</span>
                        <span class="resolution-value">{{ $socio->nom_sub_giro }}</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Zona:</span>
                        <span class="resolution-value">{{ $socio->nombre_zona }}</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Datos de Membresía</div>
                <div class="resolution-data">
                    <div class="resolution-item">
                        <span class="resolution-label">Fecha de Ingreso:</span>
                        <span class="resolution-value">15 de Agosto, 2023</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Estado:</span>
                        <span class="resolution-value">Activo</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Categoría:</span>
                        <span class="resolution-value">Socio Pleno</span>
                    </div>
                </div>
            </div>

            <div class="barcode">
                <!-- Espacio para código de barras o QR -->
                Código: {{ $socio->codigo }}
            </div>
        </div>

        <div class="watermark">SOCIO</div>

        <div class="footer">
            <p>© 2023 Asociación de Comerciantes. Todos los derechos reservados.</p>
            <p>Esta credencial es intransferible. Presentar en requerimiento de las autoridades.</p>
        </div>
    </div>
</body>
</html>