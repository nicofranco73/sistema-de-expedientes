<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Expediente</title>
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
            <h1 class="mb-4 text-center">Carga de Expediente</h1>
            <form action="procesar_carga_expediente.php" method="post" autocomplete="off">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="numero" class="form-label">Número de Expediente</label>
                        <input type="text" id="numero" name="numero" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="letra" class="form-label">Letra</label>
                        <input type="text" id="letra" name="letra" class="form-control" maxlength="1">
                    </div>
                    <div class="col-md-3">
                        <label for="anio" class="form-label">Año</label>
                        <input type="number" id="anio" name="anio" class="form-control" required min="1900" max="2100">
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" id="lugar" name="lugar" class="form-control">
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
    </div>
</body>
</html>