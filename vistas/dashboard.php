<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistema de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="sidebar-dashboard col-12 col-md-2 d-md-block sidebar px-0 py-4">
                <div class="text-center mb-4">
                    <span class="fs-4 fw-bold logo-dashboard">Expedientes</span>
                </div>
                <ul class="nav flex-column gap-1 menu-dashboard">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carga_expediente.php"><i class="bi bi-archive me-2"></i>Carga de Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resultados.php"><i class="bi bi-list-task me-2"></i>Resultados</a>
                    </li>
                    <!-- Agrega más enlaces aquí si tienes más vistas -->
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                    <h1 class="mb-0">Dashboard</h1>
                    <div>
                        <span class="me-3 text-secondary">Usuario: <strong>Admin</strong></span>
                        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="bi bi-box-arrow-right"></i> Salir</a>
                    </div>
                </div>
                <!-- Estadísticas -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card-dashboard card shadow-sm h-100 border-0">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="bi bi-files fs-2 text-primary"></i></div>
                                <h5 class="card-title">Expedientes Totales</h5>
                                <span class="display-6 fw-bold text-primary">1243</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-dashboard card shadow-sm h-100 border-0">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="bi bi-plus-circle fs-2 text-success"></i></div>
                                <h5 class="card-title">Expedientes Hoy</h5>
                                <span class="display-6 fw-bold text-success">6</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-dashboard card shadow-sm h-100 border-0">
                            <div class="card-body text-center">
                                <div class="mb-3"><i class="bi bi-exclamation-circle fs-2 text-warning"></i></div>
                                <h5 class="card-title">Pendientes</h5>
                                <span class="display-6 fw-bold text-warning">32</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Accesos rápidos -->
                <div class="d-flex flex-wrap gap-3 justify-content-center accesos-dashboard">
                    <a href="carga_expediente.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-archive"></i> Nuevo Expediente
                    </a>
                    <a href="carga_iniciador.php" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-person-plus"></i> Nuevo Iniciador
                    </a>
                    <a href="resultados.php" class="btn btn-outline-success btn-lg">
                        <i class="bi bi-list-task"></i> Ver Expedientes
                    </a>
                </div>
            </main>
        </div>
    </div>
</body>
</html>