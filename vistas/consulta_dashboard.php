<?php
session_start();
$es_admin = isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true;
$usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
// Si querés, podés agregar un redirect si no está logueado
if (!$es_admin) {
    header('Location: /expedientes/vistas/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Expedientes (Dashboard)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="main-box resultados py-4">
                    <div class="card card-resultados shadow-lg border-0 rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h2 class="titulo-principal mb-4">Consulta de Expedientes</h2>
                            <form action="resultados.php" method="get">
                                <div class="mb-3">
                                    <label for="numero" class="form-label">N° de Expediente:</label>
                                    <input type="text" class="form-control" id="numero" name="numero">
                                </div>
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>