<?php
session_start();

try {
    $db = new PDO(
        "mysql:host=localhost;dbname=Iniciadores;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Configuración de paginación
    $registros_por_pagina = 10;
    $pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
    $offset = ($pagina - 1) * $registros_por_pagina;

    // Búsqueda
    $busqueda = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';
    $where = '';
    $params = [];
    
    if ($busqueda !== '') {
        $where = "WHERE apellido LIKE :busqueda 
                  OR nombre LIKE :busqueda 
                  OR dni LIKE :busqueda";
        $params[':busqueda'] = "%$busqueda%";
    }

    // Obtener total de registros
    $sql_total = "SELECT COUNT(*) FROM persona_fisica $where";
    $stmt = $db->prepare($sql_total);
    if ($busqueda !== '') {
        $stmt->bindParam(':busqueda', $params[':busqueda']);
    }
    $stmt->execute();
    $total_registros = $stmt->fetchColumn();
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    // Obtener registros de la página actual
    $sql = "SELECT * FROM persona_fisica $where 
            ORDER BY apellido, nombre 
            LIMIT :offset, :limit";
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $registros_por_pagina, PDO::PARAM_INT);
    if ($busqueda !== '') {
        $stmt->bindParam(':busqueda', $params[':busqueda']);
    }
    $stmt->execute();
    $iniciadores = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error al cargar los iniciadores: " . $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Iniciadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
</head>
<body>
    <?php require 'header.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            <?php require 'sidebar.php'; ?>
            
            <main class="col-12 col-md-10 ms-sm-auto px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1>Listado de Iniciadores</h1>
                    <a href="carga_iniciador.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Nuevo Iniciador
                    </a>
                </div>

                <!-- Mensaje de éxito o error -->
                <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
                <?php 
                unset($_SESSION['mensaje']);
                unset($_SESSION['tipo_mensaje']);
                endif; ?>

                <!-- Buscador -->
                <form class="mb-4">
                    <div class="input-group">
                        <input type="text" 
                               name="buscar" 
                               class="form-control" 
                               placeholder="Buscar por apellido, nombre o DNI..."
                               value="<?= htmlspecialchars($busqueda) ?>">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </form>

                <!-- Tabla de iniciadores -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Apellido y Nombre</th>
                                <th>DNI</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($iniciadores as $iniciador): ?>
                            <tr>
                                <td><?= htmlspecialchars($iniciador['apellido'] . ', ' . $iniciador['nombre']) ?></td>
                                <td><?= htmlspecialchars($iniciador['dni']) ?></td>
                                <td>
                                    <?php if ($iniciador['cel']): ?>
                                        <i class="bi bi-phone"></i> <?= htmlspecialchars($iniciador['cel']) ?>
                                    <?php endif; ?>
                                    <?php if ($iniciador['tel']): ?>
                                        <br><i class="bi bi-telephone"></i> <?= htmlspecialchars($iniciador['tel']) ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($iniciador['email'] ?? '-') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="verDetalles(<?= $iniciador['id'] ?>)">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="editar_iniciador.php?id=<?= $iniciador['id'] ?>" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger"
                                            onclick="confirmarEliminar(<?= $iniciador['id'] ?>, '<?= htmlspecialchars($iniciador['apellido'] . ', ' . $iniciador['nombre']) ?>')">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
                            <a class="page-link" href="?pagina=<?= $pagina-1 ?>&buscar=<?= urlencode($busqueda) ?>">Anterior</a>
                        </li>
                        
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?= ($pagina == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>&buscar=<?= urlencode($busqueda) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <li class="page-item <?= ($pagina >= $total_paginas) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina+1 ?>&buscar=<?= urlencode($busqueda) ?>">Siguiente</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmarEliminar(id, nombre) {
        Swal.fire({
            title: '¿Eliminar iniciador?',
            html: `¿Está seguro que desea eliminar a <br><strong>${nombre}</strong>?<br>Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `eliminar_iniciador.php?id=${id}`;
            }
        });
    }
    </script>
</body>
</html>