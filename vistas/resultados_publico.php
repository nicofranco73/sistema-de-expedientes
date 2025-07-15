<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la Consulta Pública</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="../publico/css/estilos.css">
    
</head>
<body>
    <div class="container py-4">
        <div class="text-center mb-4">
            <img src="../publico/imagen/LOGOCDE.png" alt="Logo" style="height:60px;">
            <h2 class="titulo-principal mt-2">Resultados de la Consulta</h2>
        </div>

        <div class="results-container text-center">
            <h3>Resultados para su búsqueda:</h3>
            <p class="mb-4">
                Tipo: <strong><?php echo htmlspecialchars($_GET['tipo'] ?? 'N/A'); ?></strong> | 
                Año: <strong><?php echo htmlspecialchars($_GET['anio'] ?? 'N/A'); ?></strong> | 
                Letra: <strong><?php echo htmlspecialchars($_GET['letra'] ?? 'N/A'); ?></strong> | 
                Número: <strong><?php echo htmlspecialchars($_GET['numero'] ?? 'N/A'); ?></strong>
            </p>
            
            <?php
            // **IMPORTANTE:** Estos datos son de ejemplo. En un sistema real,
            // esta información vendría de una base de datos después de procesar
            // la consulta del usuario.

            $expedientes = [
                [
                    'numero_expediente' => '1001',
                    'letra' => 'A',
                    'anio' => '2022',
                    'fecha_ingreso' => '2022-08-15',
                    'lugar' => 'Mesa de Entrada',
                    'documento_url' => '#' // URL de ejemplo para descarga
                ],
                [
                    'numero_expediente' => '1002',
                    'letra' => 'B',
                    'anio' => '2023',
                    'fecha_ingreso' => '2023-02-10',
                    'lugar' => 'Oficina Central',
                    'documento_url' => '#' // URL de ejemplo para descarga
                ],
                [
                    'numero_expediente' => '1003',
                    'letra' => 'C',
                    'anio' => '2022',
                    'fecha_ingreso' => '2022-11-20',
                    'lugar' => 'Secretaría General',
                    'documento_url' => '#' // URL de ejemplo para descarga
                ],
            ];

            // Filtrado de ejemplo basado en los parámetros de URL (GET)
            $resultados_filtrados = [];
            $tipo_buscado = $_GET['tipo'] ?? '';
            $anio_buscado = $_GET['anio'] ?? '';
            $letra_buscada = $_GET['letra'] ?? '';
            $numero_buscado = $_GET['numero'] ?? '';

            foreach ($expedientes as $exp) {
                $coincide = true;
                
                // NOTA: 'tipo' no está en los datos simulados de $expedientes.
                // Si lo tuvieras en tu DB, podrías agregar un filtro como este:
                // if (!empty($tipo_buscado) && strtolower($tipo_buscado) != strtolower($exp['tipo'] ?? '')) { $coincide = false; }
                
                if (!empty($anio_buscado) && $anio_buscado != $exp['anio']) {
                    $coincide = false;
                }
                if (!empty($letra_buscada) && strtolower($letra_buscada) != strtolower($exp['letra'])) {
                    $coincide = false;
                }
                if (!empty($numero_buscado) && $numero_buscado != $exp['numero_expediente']) {
                    $coincide = false;
                }

                if ($coincide) {
                    $resultados_filtrados[] = $exp;
                }
            }

            if (!empty($resultados_filtrados)) {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover tabla-resultados">
                        <thead>
                            <tr>
                                <th scope="col">Nº Expediente</th>
                                <th scope="col">Letra</th>
                                <th scope="col">Año</th>
                                <th scope="col">Fecha Ingreso</th>
                                <th scope="col">Lugar</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resultados_filtrados as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['numero_expediente']); ?></td>
                                <td><?php echo htmlspecialchars($row['letra']); ?></td>
                                <td><?php echo htmlspecialchars($row['anio']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha_ingreso']); ?></td>
                                <td><?php htmlspecialchars($row['lugar']); ?></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-ver-detalle" title="Ver Detalle">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo htmlspecialchars($row['documento_url']); ?>" class="btn btn-sm btn-descargar" title="Descargar Documento" download>
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<p class="alert alert-info">No se encontraron expedientes con los criterios de búsqueda.</p>';
            }
            ?>

            <a href="consulta_publico.php" class="btn btn-primary mt-4">
                <i class="bi bi-arrow-left"></i> Realizar otra consulta
            </a>
            <a href="/expedientes/" class="btn btn-secondary mt-4 ms-2">
                <i class="bi bi-house"></i> Ir a Inicio
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>