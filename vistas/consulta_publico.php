<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="../publico/css/estilos.css">
    
</head>
<body>
    <div class="container py-4">
        <div class="text-center mb-4">
            <img src="../publico/imagen/LOGOCDE.png" alt="Logo" style="height:116px;">
            <h2 class="titulo-principal mt-2">Consulta de Expedientes</h2>
        </div>
        <div class="card card-form-publica">
            <div class="card-body px-4 py-5">
                <form action="resultados_publico.php" method="get" autocomplete="off">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="tipo" class="form-label">Tipo de Expediente *</label>
                            <select id="tipo" name="tipo" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option value="Proyecto de Ordenanza">Proyecto de Ordenanza</option>
                                <option value="Resolución">Resolución</option>
                                <option value="Comunicación">Comunicación</option>
                                <option value="Decreto">Decreto</option>
                                <option value="Nota">Nota</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="anio" class="form-label">Año *</label>
                            <input type="text" id="anio" name="anio" class="form-control" placeholder="Ej: 2025" required>
                        </div>
                        <div class="col-md-4">
                            <label for="letra" class="form-label">Letra</label>
                            <select id="letra" name="letra" class="form-select">
                                <option value="">-</option>
                                <?php foreach(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ') as $l): ?>
                                    <option value="<?= $l ?>"><?= $l ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="numero" class="form-label">Número *</label>
                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Ej: 1234" required>
                        </div>
                        <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                            <button type="reset" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-eraser"></i> Limpiar Campos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="../bienvenida.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</body>
</html>