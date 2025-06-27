<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión | Sistema de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="../publico/css/estilos.css">
</head>
<body>
    <div class="container">
        <div class="main-box mt-5">
            <h1 class="mb-4 text-center">Iniciar Sesión</h1>
            <form action="procesar_login.php" method="post" autocomplete="off">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-door-open-fill"></i> Ingresar
                </button>
                <div class="text-center mt-3">
                    <a href="recuperar_contrasena.php" class="link-secondary small">
                        <i class="bi bi-question-circle"></i> ¿Olvidó su contraseña?
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>