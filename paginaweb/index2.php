<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoscad | Diagnóstico y Programación Automotriz Avanzada</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-blue: #007bff;
            --dark-bg: #0f0f0f;
            --card-bg: #1a1a1a;
            --accent-glow: rgba(0, 123, 255, 0.2);
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--dark-bg);
            color: #ffffff;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(0, 0, 0, 0.9);
            border-bottom: 2px solid var(--primary-blue);
        }

        /* Hero Section */
        .hero {
            padding: 150px 0 100px;
            background: linear-gradient(rgba(15,15,15,0.8), rgba(15,15,15,0.8)), 
                        url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920') no-repeat center center/cover;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            text-shadow: 0 0 15px var(--primary-blue);
        }

        .btn-primary {
            background-color: var(--primary-blue);
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-primary:hover {
            box-shadow: 0 0 20px var(--primary-blue);
            transform: scale(1.05);
        }

        /* Services Cards */
        .service-card {
            background-color: var(--card-bg);
            border: 1px solid #333;
            border-radius: 15px;
            padding: 30px;
            transition: 0.4s;
            height: 100%;
        }

        .service-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 0 25px var(--accent-glow);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        /* Brands Section */
        .brand-badge {
            filter: grayscale(100%);
            opacity: 0.6;
            transition: 0.3s;
        }

        .brand-badge:hover {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Footer */
        footer {
            background-color: #000;
            padding: 50px 0;
            border-top: 1px solid #222;
        }
    </style>
</head>
<body>

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">AUTOSCAD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#marcas">Especialidades</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary ms-lg-3" href="https://wa.me/tu_numero">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="inicio" class="hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">INGENIERÍA AUTOMOTRIZ DE PRECISIÓN</h1>
            <p class="lead mb-5 fs-4">Especialistas en Diagnóstico, Programación y Mantenimiento de Vehículos Premium.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#servicios" class="btn btn-primary btn-lg">Nuestros Servicios</a>
                <a href="tel:+123456789" class="btn btn-outline-light btn-lg">Llamar Ahora</a>
            </div>
        </div>
    </header>

    <!-- Servicios -->
    <section id="servicios" class="py-5">
        <div class="container py-5 text-center">
            <h2 class="mb-5">Servicios de Élite</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="bi bi-cpu service-icon"></i>
                        <h3>Reprogramación</h3>
                        <p class="text-muted">Optimización de módulos de control (ECU), aumento de potencia y eficiencia de combustible.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="bi bi-laptop service-icon"></i>
                        <h3>Diagnóstico</h3>
                        <p class="text-muted">Escaneo avanzado con equipos originales para BMW, Mini, Mercedes y más.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <i class="bi bi-gear-wide-connected service-icon"></i>
                        <h3>Mecánica</h3>
                        <p class="text-muted">Mantenimiento preventivo y correctivo utilizando repuestos certificados.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marcas Especializadas -->
    <section id="marcas" class="py-5 bg-dark">
        <div class="container text-center">
            <h4 class="text-secondary mb-4">ESPECIALISTAS EN</h4>
            <div class="row align-items-center justify-content-center g-5">
                <div class="col-4 col-md-2">BMW</div>
                <div class="col-4 col-md-2">MINI</div>
                <div class="col-4 col-md-2">MERCEDES</div>
                <div class="col-4 col-md-2">AUDI</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <h2 class="mb-4">AUTOSCAD</h2>
            <p class="mb-4">Calle Falsa 123, Ciudad, País</p>
            <div class="fs-2 mb-4">
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-whatsapp"></i></a>
            </div>
            <p class="text-muted small">© 2026 Autoscad. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>