<?php
/**
 * Resultados de búsqueda pública de expedientes
 */

// Iniciar sesión y configuración
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Función para escapar output
function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    // Validar campos requeridos
    $campos_requeridos = ['numero', 'letra', 'folio', 'libro', 'anio', 'captcha'];
    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            throw new Exception("Todos los campos son requeridos");
        }
    }

    // Sanitizar y validar inputs
    $numero = filter_var($_POST['numero'], FILTER_VALIDATE_INT);
    $letra = strtoupper(substr($_POST['letra'], 0, 1));
    $folio = filter_var($_POST['folio'], FILTER_VALIDATE_INT);
    $libro = filter_var($_POST['libro'], FILTER_VALIDATE_INT);
    $anio = filter_var($_POST['anio'], FILTER_VALIDATE_INT);

    // Validar datos
    if (!$numero || !$folio || !$libro || !$anio) {
        throw new Exception("Los campos numéricos son inválidos");
    }
    
    if (!preg_match('/^[A-Z]$/', $letra)) {
        throw new Exception("Letra inválida");
    }
    
    if ($anio < 1973 || $anio > 2030) {
        throw new Exception("Año fuera de rango permitido");
    }

    // Conectar a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Consultar expediente
    $sql = "SELECT * FROM expedientes 
            WHERE numero = :numero 
            AND letra = :letra 
            AND folio = :folio 
            AND libro = :libro 
            AND anio = :anio 
            LIMIT 1";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':numero' => $numero,
        ':letra' => $letra,
        ':folio' => $folio,
        ':libro' => $libro,
        ':anio' => $anio
    ]);

    $expediente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Limpiar CAPTCHA usado
    unset($_SESSION['captcha']);

} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="publico/css/estilos.css">
</head>
<body>
    <div class="container py-4">
        <div class="text-center mb-4">
            <img src="publico/imagen/LOGOCDE.png" alt="Logo" style="height:116px;">
            <h2 class="titulo-principal mt-2">Resultado de la Consulta</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">
                    Expediente N°:  <?= e($numero) ?>/<?= e($letra) ?>/<?= e($folio) ?>/<?= e($libro) ?><?= e($anio) ?>
                    
                </h3>

                <?php if ($expediente): ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 200px">Número:</th>
                                    <td><?= e($expediente['numero']) ?></td>
                                </tr>
                                <tr>
                                    <th>Letra:</th>
                                    <td><?= e($expediente['letra']) ?></td>
                                </tr>
                                <tr>
                                    <th>Folio:</th>
                                    <td><?= e($expediente['folio']) ?></td>
                                </tr>
                                <tr>
                                    <th>Libro:</th>
                                    <td><?= e($expediente['libro']) ?></td>
                                </tr>
                                <tr>
                                    <th>Año:</th>
                                    <td><?= e($expediente['anio']) ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha de Ingreso:</th>
                                    <td><?= date('d/m/Y H:i', strtotime($expediente['fecha_hora_ingreso'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Ubicación Actual:</th>
                                    <td><?= e($expediente['lugar']) ?></td>
                                </tr>
                                <tr>
                                    <th>Extracto:</th>
                                    <td><?= e($expediente['extracto']) ?></td>
                                </tr>
                                <tr>
                                    <th>Iniciador:</th>
                                    <td><?= e($expediente['iniciador']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i>
                        No se encontró el expediente solicitado
                    </div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="index.php" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Nueva Consulta
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>