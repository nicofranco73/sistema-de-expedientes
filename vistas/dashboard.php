<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistema de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css?v=3">
</head>
<body>
    <!-- HEADER CON LOGO (NAV) -->
    <nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between px-0">
            <div class="d-flex align-items-center">
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo" class="logo-header me-3" style="height:76px;">
                <span class="fs-4 fw-bold titulo-header">Expedientes</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">Usuario: <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Salir
                </a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="sidebar-dashboard col-12 col-md-2 d-md-block sidebar px-0 py-4">
               
                <ul class="nav flex-column gap-1 menu-dashboard">
                    <li class="nav-item">
                        <a class="nav-link active" href="/expedientes/vistas/dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/carga_expedientes.php"><i class="bi bi-file-earmark-plus me-2"></i>Carga de Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/consulta.php"><i class="bi bi-search me-2"></i>Consulta de Expedientes</a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
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
                    <a href="/expedientes/vistas/carga_expedientes.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-archive"></i> Nuevo Expediente
                    </a>
                    <a href="/expedientes/vistas/carga_iniciador.php" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-person-plus"></i> Nuevo Iniciador
                    </a>
                    <!-- Eliminado el acceso rápido a Ver Expedientes -->
                </div>
                <!-- NO HAY FORMULARIO DE CONSULTA ACÁ -->
            </main>
        </div>
    </div>
</body>
</html>