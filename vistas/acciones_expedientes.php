<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expedientes - Seleccionar Rol</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-3">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo Concejo Deliberante" class="logo-header me-3"
                    height="76">
                <h1 class="fs-4 fw-bold titulo-header mb-0">Sistema de Expedientes</h1>
            </div>

            <?php if(isset($_SESSION['usuario_nombre'])): ?>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">
                    Usuario: <strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Salir
                </a>
            </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php require '../vistas/sidebar.php'; ?>

            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 text-center">
                            <h2 class="mb-4">Seleccione la acción</h2>
                           

                            <div class="row g-4 justify-content-center">
                                <!-- Tarjeta Administrador -->
                                <div class="col-12 col-md-5">
                                    <a href="carga_expedientes.php" class="text-decoration-none">
                                        <div class="card role-card h-100 shadow-sm hover-card">
                                            <div class="card-body p-4">
                                                <div class="role-icon mb-3">
                                                    <i class="bi bi-plus-circle fs-1"></i>
                                                </div>
                                                <h3 class="h4 fw-bold mb-2">Nuevo Expediente</h3>
                                                <p class="text-secondary mb-0">
                                                    Cargar un nuevo expediente al sistema
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Tarjeta Usuario Público -->
                                <div class="col-12 col-md-5">
                                    <a href="../index.php" class="text-decoration-none">
                                        <div class="card role-card h-100 shadow-sm hover-card">
                                            <div class="card-body p-4">
                                                <div class="role-icon mb-3">
                                                    <i class="bi bi-arrow-clockwise fs-1"></i>
                                                </div>
                                                <h3 class="h4 fw-bold mb-2">Actualizar Expediente</h3>
                                                <p class="text-secondary mb-0">
                                                    Modificar los datos de un expediente existente
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Estilos adicionales -->
    <style>
    .hover-card {
        transition: transform 0.2s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-5px);
    }

    .role-icon {
        color: var(--bs-primary);
    }
    </style>
</body>

</html>




