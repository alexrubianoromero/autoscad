<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProtoWork Col - Panel Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
        }
        
        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: white;
            z-index: 1030; /* Asegura que esté sobre otros elementos en móvil */
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0d6efd; /* Azul Ford */
            color: white;
            border-radius: 5px;
        }

        .brand-logo {
            padding: 20px;
            text-align: center;
            background: white;
            margin-bottom: 10px;
        }

        .card-stat {
            border: none;
            border-radius: 10px;
            transition: transform 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .main-content {
            padding: 20px;
        }

        /* Ajuste para móviles: el menú ocupará el ancho total cuando se despliegue */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: fixed;
                width: 100%;
            }
            main {
                margin-top: 60px; /* Espacio para no quedar tapado por el botón de menú */
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse shadow" id="sidebarMenu">
            <div class="brand-logo">
                <img src="https://via.placeholder.com/150x50?text=PROTOWORK" alt="Logo" class="img-fluid" style="max-height: 60px;">
            </div>
            
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-people me-2"></i> Clientes/Técnicos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-car-front me-2"></i> Motos/Carros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-file-earmark-text me-2"></i> Órdenes de Trabajo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-cash-stack me-2"></i> Facturas/Nómina
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-box-seam me-2"></i> Inventarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" data-bs-target="#sidebarMenu.show" href="#">
                            <i class="bi bi-safe me-2"></i> Caja
                        </a>
                    </li>
                    <hr class="text-white">
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Salir</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <button class="btn btn-dark d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="h4">Bienvenido, <span class="fw-bold">Admin</span></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <span class="badge bg-primary p-2"><i class="bi bi-person-circle"></i> Perfil: Administrador</span>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
                <div class="col">
                    <div class="card card-stat bg-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted small">Órdenes Activas</h6>
                                    <h2 class="fw-bold mb-0">12</h2>
                                </div>
                                <div class="icon-box text-primary fs-1"><i class="bi bi-tools"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stat bg-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted small">Vehículos hoy</h6>
                                    <h2 class="fw-bold mb-0">8</h2>
                                </div>
                                <div class="icon-box text-success fs-1"><i class="bi bi-check-circle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stat bg-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted small">Caja Diario</h6>
                                    <h2 class="fw-bold mb-0">$1.2M</h2>
                                </div>
                                <div class="icon-box text-warning fs-1"><i class="bi bi-currency-dollar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-stat bg-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted small">Alertas Stock</h6>
                                    <h2 class="fw-bold mb-0 text-danger">3</h2>
                                </div>
                                <div class="icon-box text-danger fs-1"><i class="bi bi-exclamation-triangle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold small text-uppercase" style="letter-spacing: 1px;">Últimas Órdenes de Trabajo</h5>
                </div>
                <div class="card-body p-0"> <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Vehículo</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#4502</td>
                                    <td>Ford Fiesta (ABC-123)</td>
                                    <td>Juan Pérez</td>
                                    <td><span class="badge bg-info text-dark">En Proceso</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
                                </tr>
                                <tr>
                                    <td>#4503</td>
                                    <td>Ford Ranger (XYZ-789)</td>
                                    <td>Maria López</td>
                                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                                    <td><button class="btn btn-sm btn-outline-primary">Ver</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>