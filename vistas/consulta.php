<?php
session_start();

// Captcha (si se solicita la imagen)
if (isset($_GET['captcha'])) {
    $caracteres = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    $codigo = '';
    for ($i = 0; $i < 5; $i++) {
        $codigo .= $caracteres[mt_rand(0, strlen($caracteres) - 1)];
    }
    $_SESSION['captcha'] = $codigo;

    $ancho = 120;
    $alto = 40;
    $imagen = imagecreatetruecolor($ancho, $alto);

    $fondo = imagecolorallocate($imagen, 255, 255, 255);
    $texto = imagecolorallocate($imagen, 0, 0, 0);
    $gris = imagecolorallocate($imagen, 200, 200, 200);

    imagefilledrectangle($imagen, 0, 0, $ancho, $alto, $fondo);

    for ($i = 0; $i < 7; $i++) {
        imageline($imagen, 0, mt_rand(0, $alto), $ancho, mt_rand(0, $alto), $gris);
    }

    imagestring($imagen, 5, 28, 10, $codigo, $texto);

    header('Content-type: image/png');
    imagepng($imagen);
    imagedestroy($imagen);
    exit;
}

// --- VALIDACIÓN DEL FORMULARIO Y REDIRECCIÓN ---
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $anio = $_POST['anio'] ?? '';
    $letra = $_POST['letra'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $codigo = trim($_POST['codigo'] ?? '');

    if (!$tipo || !$anio || !$numero || !$codigo) {
        $error = "Debe completar todos los campos obligatorios.";
    } elseif (!isset($_SESSION['captcha']) || strtoupper($codigo) !== $_SESSION['captcha']) {
        $error = "El código de la imagen es incorrecto.";
    } else {
        // Redirigir a resultados.php con los datos del formulario
        $params = http_build_query([
            'tipo' => $tipo,
            'anio' => $anio,
            'letra' => $letra,
            'numero' => $numero
        ]);
        unset($_SESSION['captcha']);
        header("Location: resultados.php?$params");
        exit;
    }
}

// Detecta si es usuario logueado (dashboard) o público
$es_admin = isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Expedientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/expedientes/publico/css/estilos.css?v=3">
</head>
<body>
<?php if ($es_admin): ?>
    <!-- HEADER DASHBOARD -->
    <nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-2 sticky-top">
        <div class="container align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="/expedientes/vistas/dashboard.php">
                <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo Concejo Deliberante" height="56" class="me-2" style="border-radius:8px;">
                <span class="fw-bold brand-title">Expedientes</span>
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="fw-semibold text-light">Usuario: <strong><?= htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Admin') ?></strong></span>
                <a href="/expedientes/vistas/dashboard.php" class="btn btn-outline-light">Dashboard</a>
                <a href="/expedientes/logout.php" class="btn btn-danger">Cerrar sesión</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="sidebar-dashboard col-12 col-md-2 d-md-block sidebar px-0 py-4">
                <div class="text-center mb-4">
                    <span class="fs-4 fw-bold logo-dashboard">Expedientes</span>
                </div>
                <ul class="nav flex-column gap-1 menu-dashboard">
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/dashboard.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/carga_expedientes.php"><i class="bi bi-archive me-2"></i>Carga de Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/expedientes/vistas/carga_iniciador.php"><i class="bi bi-person-plus me-2"></i>Carga de Iniciador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/expedientes/vistas/consulta.php"><i class="bi bi-list-task me-2"></i>Consulta</a>
                    </li>
                </ul>
            </nav>
            <!-- Main Content -->
            <main class="col-12 col-md-10 ms-sm-auto px-4 main-dashboard">
                <div class="main-box resultados py-4">
                    <div class="card card-resultados shadow-lg border-0 rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h2>Consulta de Expedientes</h2>
                                <p class="mb-0">
                                    Este sistema permite consultar el estado de expedientes ingresados en el <strong>Concejo Deliberante de Eldorado</strong>.<br>
                                    Si tiene dudas, comuníquese con Mesa de Entradas al <strong>(03751) 423888</strong>.<br>
                                    Complete el formulario para realizar su consulta sobre expedientes legislativos.
                                </p>
                            </div>
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?php echo $error; ?></div>
                            <?php endif; ?>
                            <form method="post" autocomplete="off">
                                <div class="mb-3">
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
                                <div class="mb-3">
                                    <label for="anio" class="form-label">Año *</label>
                                    <input type="text" id="anio" name="anio" class="form-control" placeholder="Ej: 2025" required>
                                </div>
                                <div class="mb-3">
                                    <label for="letra" class="form-label">Letra</label>
                                    <select id="letra" name="letra" class="form-select">
                                        <option value="">-</option>
                                        <?php foreach(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ') as $l): ?>
                                            <option value="<?= $l ?>"><?= $l ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Número *</label>
                                    <input type="text" id="numero" name="numero" class="form-control" placeholder="Ej: 1234" required>
                                </div>
                                <div class="mb-3">
                                    <label for="codigo" class="form-label">¿Cuál es el código de la imagen? *</label>
                                    <div class="mb-2">
                                        <img src="consulta.php?captcha=1&<?php echo time(); ?>" alt="Código de verificación" style="height:40px;">
                                        <button type="button" class="btn btn-link p-0 ms-2" onclick="this.previousElementSibling.src='consulta.php?captcha=1&'+Date.now();">Recargar</button>
                                    </div>
                                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el código" required>
                                    <div class="form-text">Introduzca los caracteres mostrados en la imagen.</div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Buscar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
<?php else: ?>
    <!-- LAYOUT PÚBLICO SIMPLE -->
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <h2>Consulta de Expedientes</h2>
                    <p class="mb-0">
                        Este sistema permite consultar el estado de expedientes ingresados en el <strong>Concejo Deliberante de Eldorado</strong>.<br>
                        Si tiene dudas, comuníquese con Mesa de Entradas al <strong>(03751) 423888</strong>.<br>
                        Complete el formulario para realizar su consulta sobre expedientes legislativos.
                    </p>
                </div>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="post" autocomplete="off">
                    <div class="mb-3">
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
                    <div class="mb-3">
                        <label for="anio" class="form-label">Año *</label>
                        <input type="text" id="anio" name="anio" class="form-control" placeholder="Ej: 2025" required>
                    </div>
                    <div class="mb-3">
                        <label for="letra" class="form-label">Letra</label>
                        <select id="letra" name="letra" class="form-select">
                            <option value="">-</option>
                            <?php foreach(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ') as $l): ?>
                                <option value="<?= $l ?>"><?= $l ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número *</label>
                        <input type="text" id="numero" name="numero" class="form-control" placeholder="Ej: 1234" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="form-label">¿Cuál es el código de la imagen? *</label>
                        <div class="mb-2">
                            <img src="consulta.php?captcha=1&<?php echo time(); ?>" alt="Código de verificación" style="height:40px;">
                            <button type="button" class="btn btn-link p-0 ms-2" onclick="this.previousElementSibling.src='consulta.php?captcha=1&'+Date.now();">Recargar</button>
                        </div>
                        <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el código" required>
                        <div class="form-text">Introduzca los caracteres mostrados en la imagen.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
</body>
</html>