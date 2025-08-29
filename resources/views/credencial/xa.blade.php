{{-- @extends('plantilla.layouts.panel')

@section('panel_blanco')
<div class="app-content content ">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">QR Generados</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('generador.index') }}">QR</a></li>
                                <li class="breadcrumb-item active">Lista</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-body">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h1>dsa</h1>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection --}}




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial de Comerciante Modulado Autorizado</title>
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
    </style>
</head>
<body>
    <div class="credential-card">
        <div class="header">
            <h1>CREDENCIAL OFICIAL</h1>
            <h2>COMERCIANTE MODULADO AUTORIZADO</h2>
            <div class="logo">CM</div>
        </div>

        <div class="content">
            <div class="photo-section">
                <div class="photo-container">
                    <div class="photo-placeholder">Fotografía 3x4</div>
                </div>
                <div class="details">
                    <div class="detail-item">
                        <div class="detail-label">Nombre</div>
                        <div class="detail-value">Carlos Antonio Mendoza Ruiz</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Ubicación</div>
                        <div class="detail-value">Av. Principal #123, Centro</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Horario</div>
                        <div class="detail-value">Lunes a Viernes: 9:00 - 18:00</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Giro/Rubro</div>
                        <div class="detail-value">Comercio de productos electrónicos</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Base Legal</div>
                <p class="legal-text">
                    Esta credencial se expide en cumplimiento del Artículo 45 de la Ley de Comercio Modulado,
                    Reglamento de Comerciantes Autorizados, según resolución No. 2847-2023 de la Dirección
                    General de Comercio. Válida por un año a partir de la fecha de emisión.
                </p>
            </div>

            <div class="section">
                <div class="section-title">Datos de Resolución</div>
                <div class="resolution-data">
                    <div class="resolution-item">
                        <span class="resolution-label">N° de Resolución:</span>
                        <span class="resolution-value">RCM-2023-5896</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Fecha de Emisión:</span>
                        <span class="resolution-value">15 de Agosto, 2023</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Fecha de Expiración:</span>
                        <span class="resolution-value">14 de Agosto, 2024</span>
                    </div>
                    <div class="resolution-item">
                        <span class="resolution-label">Categoría:</span>
                        <span class="resolution-value">Comerciante Modulado Tipo A</span>
                    </div>
                </div>
            </div>

            <div class="signature-area">
                <div class="signature">Firma del Titular</div>
                <div class="signature">Sello y Firma de Autoridad</div>
            </div>
        </div>

        <div class="watermark">AUTORIZADO</div>

        <div class="footer">
            <p>© 2023 Dirección General de Comercio Modulado. Todos los derechos reservados.</p>
            <p>Esta credencial es intransferible. Su uso es personal y obligatorio para ejercer la actividad comercial.</p>
        </div>
    </div>
</body>
</html>
