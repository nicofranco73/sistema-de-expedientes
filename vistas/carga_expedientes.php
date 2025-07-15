<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Expediente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
</head>
<body>
    <!-- HEADER CON LOGO (igual que dashboard) -->
    <nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between px-0">
            <div class="d-flex align-items-center">
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo" class="logo-header me-3" style="height:76px;">
                <span class="fs-4 fw-bold titulo-header">Expedientes</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">Usuario: <strong>Admin</strong></span>
                <a href="#" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Salir</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="sidebar-dashboard col-12 col-md-2 d-md-block sidebar px-0 py-4">
                <div class="text-center mb-4">
                    <span class="fs-4 fw-bold logo-dashboard">Expedientes</span>
                </div>
                <ul class="nav flex-column gap-1 menu-dashboard">
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/expedientes/vistas/carga_expedientes.php"><i class="bi bi-archive me-2"></i>Carga de Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/resultados.php"><i class="bi bi-list-task me-2"></i>Resultados</a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="main-box carga">
                    <h1 class="titulo-principal mb-4 text-center">Carga de Expediente</h1>
                    <form action="procesar_carga_expedientes.php" method="post" autocomplete="off">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="numero" class="form-label">Número de Expediente</label>
                                <input type="text" id="numero" name="numero" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="letra" class="form-label">Letra</label>
                                <input type="text" id="letra" name="letra" class="form-control" maxlength="1">
                            </div>
                            <div class="col-md-3">
                                <label for="anio" class="form-label">Año</label>
                                <input type="number" id="anio" name="anio" class="form-control" required min="1900" max="2100">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                                <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lugar" class="form-label">Lugar</label>
                                <input type="text" id="lugar" name="lugar" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="iniciador" class="form-label">Iniciador</label>
                                <input type="text" id="iniciador" name="iniciador" class="form-control">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-eraser"></i> Limpiar Campos
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>