<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Iniciador</title>
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
                    <h1 class="titulo-principal mb-4 text-center">Carga de Persona Jurídica / Entidad</h1>

                    <?php
                    session_start();

                    // Mostrar mensaje si existe
                    if (isset($_SESSION['mensaje'])) {
                        $tipo = $_SESSION['tipo_mensaje'] ?? 'info';
                        echo "<div class='alert alert-{$tipo} alert-dismissible fade show' role='alert'>
                                {$_SESSION['mensaje']}
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                        unset($_SESSION['mensaje']);
                        unset($_SESSION['tipo_mensaje']);
                    }

                    // Recuperar datos del formulario si hubo error
                    $form_data = $_SESSION['form_data'] ?? [];
                    unset($_SESSION['form_data']);
                    ?>

                    <form action="procesar_carga_entidad.php" method="post" autocomplete="off">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Datos generales de la entidad</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="razon_social" class="form-label">Razón social (nombre)</label>
                                        <input type="text" id="razon_social" name="razon_social" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['razon_social'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cuit" class="form-label">CUIT *</label>
                                        <input type="text" id="cuit" name="cuit" class="form-control"
                                               placeholder="Ingrese CUIT"
                                               value="<?= htmlspecialchars($form_data['cuit'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tipo_entidad" class="form-label">Tipo de entidad *</label>
                                        <select class="form-select" id="tipo_entidad" name="tipo_entidad" >
                                            <option value="">Seleccione...</option>
                                            <option value="SA" <?= ($form_data['tipo_entidad'] ?? '') === 'SA' ? 'selected' : '' ?>>Sociedad Anónima</option>
                                            <option value="AC" <?= ($form_data['tipo_entidad'] ?? '') === 'AC' ? 'selected' : '' ?>>Asociación Civil</option>
                                            <option value="FU" <?= ($form_data['tipo_entidad'] ?? '') === 'FU' ? 'selected' : '' ?>>Fundación</option>
                                            <option value="CO" <?= ($form_data['tipo_entidad'] ?? '') === 'CO' ? 'selected' : '' ?>>Cooperativa</option>
                                            <option value="OT" <?= ($form_data['tipo_entidad'] ?? '') === 'OT' ? 'selected' : '' ?>>Otra</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="personeria" class="form-label">Número de Personería Jurídica *</label>
                                        <input type="text" id="personeria" name="personeria" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['personeria'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="domicilio" class="form-label">Domicilio *</label>
                                        <input type="text" id="domicilio" name="domicilio" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['domicilio'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="localidad" class="form-label">Localidad *</label>
                                        <input type="text" id="localidad" name="localidad" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['localidad'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="provincia" class="form-label">Provincia *</label>
                                        <input type="text" id="provincia" name="provincia" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['provincia'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tel_fijo" class="form-label">Teléfono fijo</label>
                                        <input type="tel" id="tel_fijo" name="tel_fijo" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['tel_fijo'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tel_celular" class="form-label">Teléfono celular</label>
                                        <input type="tel" id="tel_celular" name="tel_celular" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['tel_celular'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Correo electrónico *</label>
                                        <input type="email" id="email" name="email" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['email'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="web" class="form-label">Página web (opcional)</label>
                                        <input type="url" id="web" name="web" class="form-control" 
                                               placeholder="https://"
                                               value="<?= htmlspecialchars($form_data['web'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Representante legal</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="rep_nombre" class="form-label">Nombre y apellido</label>
                                        <input type="text" id="rep_nombre" name="rep_nombre" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_nombre'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rep_cargo" class="form-label">Cargo</label>
                                        <select class="form-select" id="rep_cargo" name="rep_cargo">
                                            <option value="">Seleccione...</option>
                                            <option value="PR" <?= ($form_data['rep_cargo'] ?? '') === 'PR' ? 'selected' : '' ?>>Presidente</option>
                                            <option value="AP" <?= ($form_data['rep_cargo'] ?? '') === 'AP' ? 'selected' : '' ?>>Apoderado</option>
                                            <option value="GE" <?= ($form_data['rep_cargo'] ?? '') === 'GE' ? 'selected' : '' ?>>Gerente</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rep_documento" class="form-label">Número de documento</label>
                                        <input type="text" id="rep_documento" name="rep_documento" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_documento'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rep_tel_fijo" class="form-label">Teléfono fijo</label>
                                        <input type="tel" id="rep_tel_fijo" name="rep_tel_fijo" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_tel_fijo'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rep_tel_celular" class="form-label">Teléfono celular</label>
                                        <input type="tel" id="rep_tel_celular" name="rep_tel_celular" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_tel_celular'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rep_domicilio" class="form-label">Domicilio</label>
                                        <input type="text" id="rep_domicilio" name="rep_domicilio" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_domicilio'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="rep_email" class="form-label">Correo electrónico</label>
                                        <input type="email" id="rep_email" name="rep_email" class="form-control" 
                                               value="<?= htmlspecialchars($form_data['rep_email'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-save"></i> Guardar
                                </button>
                                <a href="listar_persona_juri_entidad.php" class="btn btn-info text-white">
                                    <i class="bi bi-list-ul"></i> Ver Listado
                                </a>
                            </div>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-eraser"></i> Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>