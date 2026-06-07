<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoscad | Centro Automotriz - Servicio Multimarca</title>
    <!-- Google Fonts: Montserrat para un look automotriz moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        :root {
            --as-blue: #005696; /* Azul extraído del logo */
            --as-orange: #f39200; /* Naranja de los detalles del logo */
            --as-gray: #707070; /* Gris del velocímetro */
            --as-light-gray: #f8f9fa;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
        }

        h1, h2, h3, .navbar-brand {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        /* Navbar personalizada */
        .navbar {
            background-color: white;
            border-bottom: 4px solid var(--as-blue);
            padding: 15px 0;
        }

        .navbar-brand span {
            color: var(--as-blue);
        }

        .nav-link {
            color: var(--as-blue) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        /* Hero con los colores del logo */
        .hero-section {
            background: linear-gradient(135deg, var(--as-blue) 0%, #003d6b 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        /* Elemento decorativo que emula el velocímetro del logo */
        .hero-section::after {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 400px;
            height: 400px;
            border: 40px dashed rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .btn-as-orange {
            background-color: var(--as-orange);
            color: white;
            font-weight: 700;
            border: none;
            padding: 12px 30px;
            transition: 0.3s;
        }

        .btn-as-orange:hover {
            background-color: #d67f00;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(243, 146, 0, 0.4);
        }

        /* Secciones */
        .section-title {
            color: var(--as-blue);
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--as-orange);
        }

        .card-service {
            border: none;
            border-bottom: 5px solid var(--as-gray);
            transition: 0.3s;
            background: var(--as-light-gray);
        }

        .card-service:hover {
            border-bottom-color: var(--as-orange);
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            background: var(--as-blue);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 0 auto 20px;
            font-size: 2rem;
        }

        /* Footer */
        .footer {
            background-color: var(--as-blue);
            color: white;
            padding: 60px 0 20px;
        }

        .divider-orange {
            height: 3px;
            background-color: var(--as-orange);
            width: 100%;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <!-- Aquí iría tu logo image_947c1f.png -->
                <span class="fs-3">AUTOS<b style="color:var(--as-orange)">CAD</b></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-as-orange ms-lg-3 text-white" href="#">Agendar Cita</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-section text-center text-lg-start">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-extrabold mb-3">CENTRO AUTOMOTRIZ ESPECIALIZADO</h1>
                    <p class="h3 mb-4 fw-light">Servicio Multimarca con Tecnología de Punta</p>
                    <p class="lead mb-5 opacity-75">En Autoscad cuidamos tu vehículo con la precisión que el logo que nos representa exige: velocidad, confianza y profesionalismo.</p>
                    <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                        <a href="#servicios" class="btn btn-as-orange btn-lg">Ver Servicios</a>
                        <a href="tel:+57" class="btn btn-outline-light btn-lg">Contactar a un Técnico</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <!-- Representación visual del auto del logo -->
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=800" alt="Auto Premium" class="img-fluid rounded-3 shadow-lg border border-4 border-white">
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Basados en el Logo -->
    <section id="servicios" class="py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title">Nuestra Experiencia</h2>
                <p class="text-muted">Soluciones integrales para mantener tu motor a máxima potencia.</p>
            </div>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card h-100 card-service p-4">
                        <div class="icon-box"><i class="bi bi-speedometer"></i></div>
                        <h4 class="fw-bold">Diagnóstico Escáner</h4>
                        <p class="text-muted small">Identificamos fallas con precisión milimétrica usando equipos de última generación.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 card-service p-4">
                        <div class="icon-box"><i class="bi bi-tools"></i></div>
                        <h4 class="fw-bold">Mecánica General</h4>
                        <p class="text-muted small">Desde frenos hasta suspensión, cubrimos todas las necesidades de tu vehículo multimarca.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 card-service p-4">
                        <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                        <h4 class="fw-bold">Sincronización</h4>
                        <p class="text-muted small">Optimizamos el consumo de combustible y el rendimiento del motor.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Banner de Confianza -->
    <section class="bg-light py-5 border-top border-bottom">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="fw-bold text-dark m-0">¿Tu vehículo necesita atención profesional?</h3>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <a href="https://wa.me/57..." class="btn btn-success btn-lg shadow"><i class="bi bi-whatsapp me-2"></i>Escríbenos ahora</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer con Colores Corporativos -->
    <footer class="footer">
        <div class="container">
            <div class="divider-orange"></div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="fw-bold mb-3">AUTOSCAD</h4>
                    <p class="opacity-75">Centro Automotriz - Servicio Multimarca. Pasión por la mecánica, compromiso con tu seguridad.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Ubicación</h5>
                    <ul class="list-unstyled opacity-75">
                        <li><i class="bi bi-geo-alt me-2"></i> Calle Principal, Ciudad</li>
                        <li><i class="bi bi-telephone me-2"></i> +57 300 000 0000</li>
                        <li><i class="bi bi-envelope me-2"></i> contacto@autoscad.com</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Horario de Atención</h5>
                    <p class="opacity-75">Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábados: 8:00 AM - 1:00 PM</p>
                </div>
            </div>
            <hr class="mt-4 opacity-25">
            <div class="text-center opacity-50 small">
                © 2026 Autoscad. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>