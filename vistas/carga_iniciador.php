<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Iniciador</title>
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
            <h1 class="mb-4 text-center">Carga de Iniciador</h1>
            <form action="procesar_carga_iniciador.php" method="post" autocomplete="off">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" id="dni" name="dni" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="tel" class="form-label">Teléfono Fijo</label>
                        <input type="text" id="tel" name="tel" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="cel" class="form-label">Teléfono Celular</label>
                        <input type="text" id="cel" name="cel" class="form-control">
                    </div>
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="observacion" class="form-label">Observación</label>
                        <input type="text" id="observacion" name="observacion" class="form-control">
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
    </div>
</body>
</html>