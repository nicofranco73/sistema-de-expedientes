<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - Sistema de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="publico/css/estilos.css">
    
</head>
<body>
    <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 text-center">
                <div class="text-center mb-5">
                    <img src="publico/imagen/LOGOCDE.png" alt="Logo" class="img-fluid" style="max-height: 120px; width: auto;">
                    <h1 class="fw-bold mt-3" style="color:#203864;">Sistema de Expedientes</h1>
                    <p class="lead text-secondary">Seleccione su tipo de acceso</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-5">
                        <a href="vistas/login.php" style="text-decoration:none">
                            <div class="card role-card text-center py-4 shadow">
                                <div class="card-body">
                                    <div class="role-icon mb-3"><i class="bi bi-person-lock"></i></div>
                                    <h4 class="fw-bold mb-1">Administrador</h4>
                                    <div class="text-secondary">Acceso a panel administrativo</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-5">
                        <a href="vistas/consulta_publico.php" style="text-decoration:none">
                            <div class="card role-card text-center py-4 shadow">
                                <div class="card-body">
                                    <div class="role-icon mb-3"><i class="bi bi-person"></i></div>
                                    <h4 class="fw-bold mb-1">Usuario</h4>
                                    <div class="text-secondary">Consulta expedientes públicos</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>