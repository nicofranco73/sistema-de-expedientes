<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Iniciador</title>
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
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo" class="logo-header me-3" style="height:56px;">
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
                        <a class="nav-link" href="/expedientes/vistas/carga_expedientes.php"><i class="bi bi-archive me-2"></i>Carga de Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/expedientes/vistas/carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/resultados.php"><i class="bi bi-list-task me-2"></i>Resultados</a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="main-box carga">
                    <h1 class="titulo-principal mb-4 text-center">Carga de Iniciador</h1>
                    <form action="procesar_carga_iniciador.php" method="post" autocomplete="off">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" id="apellido" name="apellido" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" id="dni" name="dni" class="form-control" required>
                            </div>
                            <div class="col-md-8">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="tel" class="form-label">Teléfono Fijo</label>
                                <input type="text" id="tel" name="tel" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cel" class="form-label">Teléfono Celular</label>
                                <input type="text" id="cel" name="cel" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="observacion" class="form-label">Observación</label>
                                <input type="text" id="observacion" name="observacion" class="form-control">
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