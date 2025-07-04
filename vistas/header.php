<?php
// IMPORTANTE: Antes de incluir este archivo, asegurate de definir:
// $es_admin = isset($_SESSION['usuario_logueado']) && $_SESSION['usuario_logueado'] === true;
// $usuario_nombre = $_SESSION['usuario_nombre'] ?? 'Usuario';
?>
<nav class="navbar navbar-expand-lg header-dashboard shadow-sm py-2 sticky-top">
    <div class="container align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="/expedientes/vistas/dashboard.php">
            <img src="/expedientes/publico/imagen/LOGOCDE.png" alt="Logo Concejo Deliberante" height="56" class="me-2" style="border-radius:8px;">
            <span class="fw-bold brand-title">Concejo Deliberante</span>
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <?php if ($es_admin): ?>
                <span class="fw-semibold text-light">Bienvenido, <?= htmlspecialchars($usuario_nombre) ?></span>
                <a href="/expedientes/vistas/dashboard.php" class="btn btn-outline-light">Dashboard</a>
                <a href="/expedientes/logout.php" class="btn btn-danger">Cerrar sesión</a>
            <?php else: ?>
                <a href="/expedientes/login.php" class="btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" title="Iniciar sesión">
                    <i class="bi bi-person-circle fs-4"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>