<?php
session_start();
$usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
    <style>
        .card-form-centered {
            max-width: 650px;
            margin: 48px auto;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(70, 89, 125, 0.08);
        }
        .card-form-centered .form-control {
            background: #faf9f9;
        }
        .titulo-principal {
            font-weight: 700;
            color: #203864;
        }
        @media (max-width: 767px) {
            .card-form-centered {
                margin: 24px auto;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER CON LOGO -->
    <nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-3">
        <div class="container-fluid d-flex align-items-center justify-content-between px-0">
            <div class="d-flex align-items-center">
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo" class="logo-header me-3" style="height:76px;">
                <span class="fs-4 fw-bold titulo-header">Expedientes</span>
            </div>
            <div class="d-flex align-items-center">
                <span class="me-3 text-secondary">Usuario: <strong><?= htmlspecialchars($usuario_nombre) ?></strong></span>
                <a href="/expedientes/logout.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Salir</a>
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
                        <a class="nav-link" href="/expedientes/vistas/carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/expedientes/vistas/consulta.php"><i class="bi bi-list-task me-2"></i>Consulta</a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard d-flex align-items-center justify-content-center" style="min-height: 85vh;">
                <div class="card card-form-centered w-100">
                    <div class="card-body px-4 py-5">
                        <h1 class="titulo-principal mb-4 text-center">Consulta de Expediente</h1>
                        <p class="mb-4 text-center">
                            Este sistema permite consultar el estado de expedientes ingresados en el <strong>Concejo Deliberante de Eldorado</strong>.<br>
                            Si tiene dudas, comuníquese con Mesa de Entradas al <strong>(03751) 424340</strong>.<br>
                            Complete el formulario para realizar su consulta sobre expedientes legislativos.
                        </p>
                        <!-- FORMULARIO -->
                        <form action="resultados.php" method="get" autocomplete="off">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="tipo" class="form-label">Tipo de Expediente *</label>
                                    <select id="tipo" name="tipo" class="form-select" required>
                                        <option value="">Seleccione...</option>
                                        <option value="Proyecto de Ordenanza">Proyecto de Ordenanza</option>
                                        <option value="Resolución">Resolución</option>
                                        <option value="Comunicación">Comunicación</option>
                                        <option value="Decreto">Decreto</option>
                                        <option value="Nota">Nota</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="anio" class="form-label">Año *</label>
                                    <input type="text" id="anio" name="anio" class="form-control" placeholder="Ej: 2025" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="letra" class="form-label">Letra</label>
                                    <select id="letra" name="letra" class="form-select">
                                        <option value="">-</option>
                                        <?php foreach(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ') as $l): ?>
                                            <option value="<?= $l ?>"><?= $l ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="numero" class="form-label">Número *</label>
                                    <input type="text" id="numero" name="numero" class="form-control" placeholder="Ej: 1234" required>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-eraser"></i> Limpiar Campos
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- FIN FORMULARIO -->
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>