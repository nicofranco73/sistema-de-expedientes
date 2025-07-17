<?php
session_start();

try {
    // Conexión a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Configuración de paginación
    $por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
    $offset = ($pagina - 1) * $por_pagina;

    // Consulta total de registros
    $total = $db->query("SELECT COUNT(*) FROM expedientes")->fetchColumn();
    $total_paginas = ceil($total / $por_pagina);

    // Consulta de expedientes con paginación
    $sql = "SELECT * FROM expedientes 
            ORDER BY fecha_hora_ingreso DESC 
            LIMIT :offset, :limit";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
    $stmt->execute();
    
    $expedientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al cargar los expedientes: " . $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
    <style>
    .swal2-html-container.text-start {
        text-align: left !important;
    }

    .swal2-html-container .table {
        font-size: 0.9em;
    }

    .swal2-html-container .table th {
        background-color: #f8f9fa;
    }
    </style>
</head>

<body>
    <?php require 'header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php require 'sidebar.php'; ?>
            
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="titulo-principal">Listado de Expedientes</h1>
                   
                </div>

                <?php if (!empty($_SESSION['mensaje'])): ?>
                    <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show">
                        <?= htmlspecialchars($_SESSION['mensaje']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']); ?>
                <?php endif; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Letra</th>
                                        <th>Folio</th>
                                        <th>Libro</th>
                                        <th>Año</th>
                                        <th>Lugar actual</th>
                                        <th>Fecha Ingreso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($expedientes as $exp): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($exp['numero']) ?></td>
                                        <td><?= htmlspecialchars($exp['letra']) ?></td>
                                        <td><?= htmlspecialchars($exp['folio']) ?></td>
                                        <td><?= htmlspecialchars($exp['libro']) ?></td>
                                        <td><?= htmlspecialchars($exp['anio']) ?></td>
                                        <td><?= htmlspecialchars($exp['lugar']) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($exp['fecha_hora_ingreso'])) ?></td>
                                        <td>
                                            <a href="actualizar_expedientes.php?id=<?= htmlspecialchars($exp['id']) ?>" 
                                               class="btn btn-sm btn-outline-primary"
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-info"
                                                    onclick="verDetalles(<?= $exp['id'] ?>)"
                                                    title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="confirmarBorrado(<?= $exp['id'] ?>, '<?= htmlspecialchars($exp['numero']) ?>', '<?= htmlspecialchars($exp['letra']) ?>', '<?= htmlspecialchars($exp['anio']) ?>')"
                                                    title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <a href="pases_expediente.php?id=<?= htmlspecialchars($exp['id']) ?>" 
                                               class="btn btn-sm btn-outline-success"
                                               title="Pases">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <?php if ($total_paginas > 1): ?>
                        <nav aria-label="Navegación de páginas" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= ($pagina <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $pagina-1 ?>">Anterior</a>
                                </li>
                                
                                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                    <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                                        <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $pagina+1 ?>">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    async function verDetalles(id) {
        try {
            // Mostrar loader
            Swal.fire({
                title: 'Cargando...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            // Obtener datos del expediente e historial en paralelo
            const [expedienteResp, historialResp] = await Promise.all([
                fetch(`obtener_expediente.php?id=${id}`),
                fetch(`obtener_historial_pases.php?id=${id}`)
            ]);

            const expediente = await expedienteResp.json();
            const historial = await historialResp.json();

            // Crear tabla de historial
            let historialHTML = '';
            if (historial.success && historial.data.length > 0) {
                historialHTML = `
                    <h6 class="mt-4 mb-3">Historial de Pases</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Desde</th>
                                    <th>Hacia</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${historial.data.map(pase => `
                                    <tr>
                                        <td>${pase.fecha_formateada}</td>
                                        <td>${pase.lugar_anterior}</td>
                                        <td>${pase.lugar_nuevo}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>`;
            }

            // Mostrar modal con toda la información
            Swal.fire({
                title: `Expediente ${expediente.numero}/${expediente.letra}/${expediente.anio}`,
                html: `
                    <div class="text-start">
                        <p><strong>Iniciador:</strong> ${expediente.iniciador}</p>
                        <p><strong>Extracto:</strong> ${expediente.extracto}</p>
                        <p><strong>Lugar actual:</strong> ${expediente.lugar}</p>
                        <p><strong>Fecha de ingreso:</strong> ${expediente.fecha_hora_ingreso}</p>
                        ${historialHTML}
                    </div>
                `,
                width: '800px',
                customClass: {
                    htmlContainer: 'swal2-html-container text-start'
                }
            });

        } catch (error) {
            console.error('Error:', error);
            Swal.fire('Error', 'No se pudo cargar la información', 'error');
        }
    }

    function confirmarBorrado(id, numero, letra, anio) {
        Swal.fire({
            title: '¿Eliminar expediente?',
            html: `¿Está seguro que desea eliminar el expediente <br><strong>${numero}/${letra}/${anio}</strong>?<br>Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarExpediente(id);
            }
        });
    }

    async function eliminarExpediente(id) {
        try {
            const response = await fetch('eliminar_expediente.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id })
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    title: 'Eliminado',
                    text: 'El expediente ha sido eliminado correctamente',
                    icon: 'success'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Error al eliminar el expediente');
            }
        } catch (error) {
            Swal.fire({
                title: 'Error',
                text: error.message,
                icon: 'error'
            });
        }
    }
    </script>
</body>
</html>