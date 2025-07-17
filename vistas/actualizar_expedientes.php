<?php
session_start();
define('MAX_EXTRACTO', 300);
// Obtener el expediente por ID
if (isset($_GET['id'])) {
    try {
        $db = new PDO(
            "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $stmt = $db->prepare("SELECT * FROM expedientes WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $expediente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$expediente) {
            $_SESSION['mensaje'] = "Expediente no encontrado";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: listar_expedientes.php");
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al cargar el expediente: " . $e->getMessage();
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: listar_expedientes.php");
        exit;
    }
} else {
    $_SESSION['mensaje'] = "ID de expediente no proporcionado";
    $_SESSION['tipo_mensaje'] = "danger";
    header("Location: listar_expedientes.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carga de Expediente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css">
    <style>
.historial-modal .swal2-html-container {
    margin: 1em 0;
}

.historial-modal .table {
    margin-bottom: 0;
}

.historial-modal .table-responsive {
    max-height: 400px;
    overflow-y: auto;
}

.historial-modal th {
    position: sticky;
    top: 0;
    background-color: #f8f9fa;
    z-index: 1;
}

.historial-modal td {
    vertical-align: middle;
}

input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}
</style>
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
            <?php require '../vistas/sidebar.php'; ?>
            <!-- Sidebar -->


            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="main-box carga">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="titulo-principal text-center">Actualizar Expediente</h1>
                        <a href="listar_expedientes.php" class="btn btn-primary">
                            <i class="bi bi-list-ul"></i> Listar Expedientes
                        </a>
                    </div>
                    <?php
                    session_start();

                    if (isset($_SESSION['mensaje'])) {
                        $tipo = $_SESSION['tipo_mensaje'] ?? 'info';
                        // Convertir tipo de Bootstrap a SweetAlert2
                        $icon = match($tipo) {
                            'success' => 'success',
                            'danger' => 'error',
                            'warning' => 'warning',
                            default => 'info'
                        };
                        ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    title: '<?= htmlspecialchars($_SESSION['mensaje']) ?>',
                                    icon: '<?= $icon ?>',
                                    confirmButtonText: 'Aceptar',
                                    confirmButtonColor: '#0d6efd'
                                });
                            });
                        </script>
                        <?php
                        unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
                    }
                    ?>
                    <form action="procesar_actualizacion.php" method="post" autocomplete="off">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($expediente['id'] ?? '') ?>">
                        
                        <div class="row g-3">
                            <!-- Número -->
                            <div class="col-md-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" 
                                       id="numero" 
                                       name="numero" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['numero'] ?? '') ?>" 
                                       readonly>
                            </div>

                            <!-- Letra -->
                            <div class="col-md-3">
                                <label for="letra" class="form-label">Letra</label>
                                <input type="text" 
                                       id="letra" 
                                       name="letra" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['letra'] ?? '') ?>" 
                                       readonly>
                            </div>

                            <!-- Folio -->
                            <div class="col-md-3">
                                <label for="folio" class="form-label">Folio</label>
                                <input type="text" 
                                       id="folio" 
                                       name="folio" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['folio'] ?? '') ?>" 
                                       readonly>
                            </div>

                            <!-- Año -->
                            <div class="col-md-3">
                                <label for="anio" class="form-label">Año</label>
                                <input type="text" 
                                       id="anio" 
                                       name="anio" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['anio'] ?? '') ?>" 
                                       readonly>
                            </div>

                            <!-- Lugar -->
                            <div class="col-md-6">
                                <label for="lugar" class="form-label">Lugar</label>
                                <input type="text" 
                                       id="lugar" 
                                       name="lugar" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['lugar'] ?? '') ?>" 
                                       readonly>
                            </div>

                            <!-- Extracto -->
                            <div class="col-12">
                                <label for="extracto" class="form-label">Extracto</label>
                                <textarea id="extracto" 
                                          name="extracto" 
                                          class="form-control" 
                                          rows="3"><?= htmlspecialchars($expediente['extracto'] ?? '') ?></textarea>
                                <div class="form-text">Máximo <?= MAX_EXTRACTO ?> caracteres (opcional)</div>
                            </div>

                            <!-- Iniciador -->
                            <div class="col-12">
                                <label for="iniciador" class="form-label">Iniciador</label>
                                <input type="text" 
                                       id="iniciador" 
                                       name="iniciador" 
                                       class="form-control" 
                                       value="<?= htmlspecialchars($expediente['iniciador'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-save"></i> Guardar Cambios
                                </button>
                                <!--<button type="button" class="btn btn-info text-white" onclick="verHistorial(<?= $expediente['id'] ?>)">
                                    <i class="bi bi-clock-history"></i> Ver Historial
                                </button>-->
                            </div>
                            <a href="listar_expedientes.php" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const MAX_EXTRACTO = 300;

    // Solo validar el extracto si tiene contenido
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const extractoValue = extracto.value.trim();
        if (extractoValue && extractoValue.length > MAX_EXTRACTO) {
            extracto.classList.add('is-invalid');
            Swal.fire({
                title: 'Error en el extracto',
                text: `El extracto no puede superar los ${MAX_EXTRACTO} caracteres`,
                icon: 'warning',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#0d6efd'
            });
            return;
        }

        // Confirmar envío
        Swal.fire({
            title: '¿Desea guardar los cambios?',
            text: 'Verifique que los datos sean correctos',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Verificar que tengamos un ID en la URL
document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    if (!params.has('id')) {
        Swal.fire({
            title: 'Error',
            text: 'No se especificó un expediente para editar',
            icon: 'error',
            confirmButtonText: 'Volver',
        }).then(() => {
            window.location.href = 'listar_expedientes.php';
        });
    }
});
</script>
<script>
async function verHistorial(id) {
    try {
        // Mostrar loader
        Swal.fire({
            title: 'Cargando historial...',
            didOpen: () => {
                Swal.showLoading();
            },
            allowOutsideClick: false
        });

        // Hacer la petición
        const response = await fetch(`obtener_historial.php?id=${id}`);
        const resultado = await response.json();

        // Cerrar loader
        Swal.close();

        if (!resultado.success) {
            throw new Error(resultado.message);
        }

        if (!resultado.data || resultado.data.length === 0) {
            Swal.fire({
                title: 'Sin cambios',
                text: 'Este expediente no tiene historial de cambios registrados',
                icon: 'info'
            });
            return;
        }

        // Crear tabla HTML
        let html = `
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Fecha</th>
                            <th>Ubicación Anterior</th>
                            <th>Nueva Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        // Agregar filas
        resultado.data.forEach(cambio => {
            const fecha = new Date(cambio.fecha_cambio).toLocaleString('es-AR', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit'
            });

            html += `
                <tr>
                    <td>${fecha}</td>
                    <td>${cambio.lugar_anterior}</td>
                    <td>${cambio.lugar_nuevo}</td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        // Mostrar modal
        Swal.fire({
            title: 'Historial de Cambios',
            html: html,
            width: '800px',
            confirmButtonText: 'Cerrar',
            customClass: {
                container: 'historial-modal'
            }
        });

    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo cargar el historial: ' + error.message,
            icon: 'error'
        });
    }
}
</script>

</html>
</body>
</body>

</html>