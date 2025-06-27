<?php
$expedientes = [
    [
        'numero' => '1001',
        'letra' => 'A',
        'anio' => 2022,
        'fecha_ingreso' => '2022-08-15',
        'lugar' => 'Mesa de Entrada'
    ],
    [
        'numero' => '1002',
        'letra' => 'B',
        'anio' => 2023,
        'fecha_ingreso' => '2023-02-10',
        'lugar' => 'Oficina Central'
    ]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-resultados shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="titulo-principal mb-0">Resultados de Expedientes</h2>
                            <a href="#" class="btn btn-outline-success btn-exportar" title="Exportar resultados">
                                <i class="bi bi-box-arrow-down"></i> Exportar
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 tabla-resultados">
                                <thead class="table-light">
                                    <tr>
                                        <th>N° Expediente</th>
                                        <th>Letra</th>
                                        <th>Año</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Lugar</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($expedientes as $exp): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($exp['numero']) ?></td>
                                        <td><?= htmlspecialchars($exp['letra']) ?></td>
                                        <td><?= htmlspecialchars($exp['anio']) ?></td>
                                        <td><?= htmlspecialchars($exp['fecha_ingreso']) ?></td>
                                        <td><?= htmlspecialchars($exp['lugar']) ?></td>
                                        <td class="text-center">
                                            <a href="ver_detalle.php?numero=<?= urlencode($exp['numero']) ?>&letra=<?= urlencode($exp['letra']) ?>&anio=<?= urlencode($exp['anio']) ?>"
                                               class="btn btn-primary btn-sm me-1 btn-ver-detalle" title="Ver Detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="descargar.php?numero=<?= urlencode($exp['numero']) ?>&letra=<?= urlencode($exp['letra']) ?>&anio=<?= urlencode($exp['anio']) ?>"
                                               class="btn btn-outline-secondary btn-sm btn-descargar" title="Descargar">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($expedientes)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No se encontraron expedientes.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- aquí va paginación si hace falta -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>