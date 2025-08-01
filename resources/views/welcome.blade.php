<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente IA para Matching de Perfiles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container, .problem-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        #result {
            margin-top: 20px;
            padding: 15px;
            background: #e8f5e9;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Registro de Perfiles Profesionales</h1>
    
    <!-- Formulario de Registro -->
    <div class="form-container">
        <h2>Regístrate</h2>
        <form id="profileForm">
            <input type="text" id="name" placeholder="Nombre completo" required>
            <input type="text" id="profession" placeholder="Profesión (ej: Ingeniero, Médico)" required>
            <input type="text" id="specialty" placeholder="Especialidad (ej: IA, Cardiología)" required>
            <textarea id="experience" placeholder="Experiencia (detalla tus habilidades)" rows="4" required></textarea>
            <button type="submit">Guardar Perfil</button>
        </form>
    </div>

    <!-- Consultar Problemática -->
    <div class="problem-container">
        <h2>Consultar Problemática</h2>
        <textarea id="problem" placeholder="Describe tu problema o necesidad..." rows="4" required></textarea>
        <button onclick="findBestProfile()">Encontrar Mejor Perfil</button>
        <div id="result"></div>
    </div>

    <script>
        // Base de datos de perfiles (simulada)
        let profiles = [];

        // Registrar perfil
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const profile = {
                name: document.getElementById('name').value,
                profession: document.getElementById('profession').value,
                specialty: document.getElementById('specialty').value,
                experience: document.getElementById('experience').value
            };
            profiles.push(profile);
            alert(`Perfil de ${profile.name} registrado con éxito!`);
            this.reset();
        });

        // IA: Encontrar el mejor perfil (simulación con lógica básica o API de IA)
        async function findBestProfile() {
            const problem = document.getElementById('problem').value;
            if (!problem || profiles.length === 0) {
                alert("Ingresa un problema y asegúrate de haber registrado perfiles.");
                return;
            }

            // Simulación de IA (para producción, usa una API como OpenAI)
            const bestProfile = simulateAI(problem);
            
            // Mostrar resultado
            document.getElementById('result').innerHTML = `
                <h3>Perfil Recomendado:</h3>
                <p><strong>Nombre:</strong> ${bestProfile.name}</p>
                <p><strong>Profesión:</strong> ${bestProfile.profession}</p>
                <p><strong>Especialidad:</strong> ${bestProfile.specialty}</p>
                <p><strong>Razón:</strong> ${bestProfile.reason}</p>
            `;
        }

        // Lógica de IA simulada (o conecta a una API real)
        function simulateAI(problem) {
            // 1. Puntúa cada perfil según keywords en el problema
            const scoredProfiles = profiles.map(profile => {
                let score = 0;
                const problemLower = problem.toLowerCase();
                if (problemLower.includes(profile.specialty.toLowerCase())) score += 3;
                if (problemLower.includes(profile.profession.toLowerCase())) score += 2;
                if (profile.experience.toLowerCase().includes(problemLower)) score += 1;
                return { ...profile, score };
            });

            // 2. Ordena por puntuación y elige el mejor
            scoredProfiles.sort((a, b) => b.score - a.score);
            const bestProfile = scoredProfiles[0];

            // 3. Genera una razón (en un caso real, usa GPT para esto)
            bestProfile.reason = `Este perfil tiene la especialidad "${bestProfile.specialty}" y experiencia relevante en "${bestProfile.experience.substring(0, 50)}..."`;
            
            return bestProfile;
        }

        /* Versión con API de OpenAI (descomenta y reemplaza tu API key)
        async function findBestProfileWithAPI(problem) {
            const response = await fetch("https://api.openai.com/v1/chat/completions", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer TU_API_KEY"
                },
                body: JSON.stringify({
                    model: "gpt-4",
                    messages: [
                        {
                            role: "system",
                            content: `Eres un asistente que recomienda el mejor perfil profesional. 
                                      Base de datos: ${JSON.stringify(profiles)}`
                        },
                        {
                            role: "user",
                            content: `Problema: ${problem}. ¿Quién es el mejor profesional para esto?`
                        }
                    ]
                })
            });
            const data = await response.json();
            return data.choices[0].message.content;
        }
        */
    </script>
</body>
</html>