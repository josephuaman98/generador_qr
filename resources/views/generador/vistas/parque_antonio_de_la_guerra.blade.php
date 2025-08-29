<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Origen Ychma</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #8E7D5B;
            --color-secondary: #3D5A59;
            --color-accent: #C4A77D;
            --color-light: #F9F5EB;
            --color-dark: #2C2C2C;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--color-light);
            color: var(--color-dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }
        
        .container {
            max-width: 900px;
            width: 100%;
        }
        
        .title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            color: var(--color-secondary);
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        
        .subtitle {
            font-size: 1.2rem;
            color: var(--color-primary);
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 3rem;
            background: #000;
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .content {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .content p {
            margin-bottom: 1.5rem;
        }
        
        .highlight {
            color: var(--color-primary);
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .title {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1rem;
            }
            
            body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">EL ORIGEN YCHMA</h1>
        
        <p class="subtitle">Una mirada al nacimiento de la cultura Ychma en los valles de Lurín y Rímac</p>
        
        <div class="video-container">
            <!-- Video representativo de la cultura peruana antigua -->
            <iframe src="https://www.youtube.com/embed/5kXD0oRSLTY?rel=0&modestbranding=1" 
                    title="Culturas antiguas del Perú" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
            </iframe>
        </div>
        
        <div class="content">
            <p>Con ingenio, transformaron el desierto en fértiles campos agrícolas mediante complejos canales de irrigación. El inicio de una historia que marcaría la identidad de Lima.</p>
            
            <p>La cultura Ychma surgió entre los años 1000 d.C. y 1470 d.C., destacando por sus avanzados sistemas hidráulicos y su arquitectura monumental que aún perdura en sitios como Pachacámac.</p>
        </div>
    </div>
</body>
</html>