<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carga de Expediente</title>
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
                    <h1 class="titulo-principal mb-4 text-center">Carga de Expediente</h1>
                    <form action="procesar_carga_expedientes.php" method="post" autocomplete="off">
                        <div class="row g-3">
                            <!--  Numero-->
                            <div class="col-md-6">
                                <label for="numero" class="form-label">Número *</label>
                                <input type="text"
                                    id="numero"
                                    name="numero"
                                    class="form-control"
                                    placeholder="Ej: 1234"
                                    pattern="[0-9]{1,6}"
                                    maxlength="6"
                                    title="Solo números, máximo 6 dígitos"
                                    required>
                            </div>
                            <!--  Letra-->
                            <div class="col-md-3">
                                <label for="letra" class="form-label">Letra *</label>
                                <select id="letra"
                                    name="letra"
                                    class="form-select"
                                    required>
                                    <option value="">Elige una letra</option>
                                    <?php foreach (str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ') as $l): ?>
                                        <option value="<?= htmlspecialchars($l, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($l, ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!--  Año-->
                            <div class="col-md-3">
                                <label for="anio" class="form-label">Año *</label>
                                <select id="anio" name="anio" class="form-select" required>
                                    <option value="">Elige un año</option>
                                    <?php for ($y = 1973; $y <= 2030; $y++): ?>
                                        <option value="<?= htmlspecialchars($y, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($y, ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">

                            <!--  Fecha y hora de ingreso -->
                            <div class="col-md-6">
                                <label for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso *</label>
                                <input type="datetime-local" id="fecha_hora_ingreso" name="fecha_hora_ingreso" class="form-control" required>
                            </div>
                            <!--  Lugar -->
                            <div class="col-md-6">
                                <label for="lugar" class="form-label">Lugar</label>
                                <select id="lugar" name="lugar" class="form-select">
                                    <option value="">Seleccione un lugar</option>
                                    <option value="Mesa de Entrada">Mesa de Entrada</option>
                                    <option value="Comision I">Comision I</option>
                                </select>
                            </div>





                        </div>




                        
                        
                        <div class="col-12">
                            <label for="iniciador" class="form-label">Iniciador</label>
                            <input type="text" id="iniciador" name="iniciador" class="form-control">
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