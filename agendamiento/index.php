<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Citas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Estilos generales para el fondo y el centrado */
        .portada {
            background-image: url('./fondotaller.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        /* Capa oscura para mejorar la legibilidad del texto */
        .portada::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        /* Contenedor del contenido principal */
        .contenido-central {
            position: relative; /* Para que esté por encima del overlay */
            z-index: 10;
            color: white;
            max-width: 500px;
            padding: 30px;
        }

        .contenido-central h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .formulario-placa {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .formulario-placa label {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .formulario-placa .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            text-align: center;
            font-size: 1.5rem;
            padding: 15px;
            height: 70px;
            font-weight: 500;
        }

        .formulario-placa .btn-primary {
            background-color: white;
            color: black;
            font-weight: bold;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }
        
        .formulario-placa .btn-primary:hover {
            background-color: #e0e0e0;
        }

        /* Para dispositivos móviles */
        @media (max-width: 768px) {
            .contenido-central h1 {
                font-size: 2rem;
            }
            .formulario-placa .form-control {
                font-size: 1.2rem;
                height: 50px;
            }
        }
    </style>
</head>
<body>

    <div class="portada">
        <div class="contenido-central">
            <h1>Agenda tu Cita Rápido y Fácil</h1>
            <div class="formulario-placa">
                <label for="txtPlaca">Placa del vehículo</label>
                <input type="text" id="txtPlaca" placeholder="PLACA" class="form-control" maxlength="7">
                <button type="button" id="btnVerificarPlaca" class="btn btn-primary w-100 mt-3">
                    Verificar y Agendar
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Aquí iría tu código JavaScript para el manejo del botón
        document.getElementById('btnVerificarPlaca').addEventListener('click', function() {
            let placa = document.getElementById('txtPlaca').value;
            // Lógica de verificación con AJAX aquí
            alert('Verificando la placa: ' + placa);
        });
    </script>
</body>
</html>