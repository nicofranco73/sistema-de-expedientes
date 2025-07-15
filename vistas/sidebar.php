<nav class="sidebar-dashboard col-12 col-md-2 d-md-block sidebar px-0 py-4">
    <div class="text-center mb-4">
        <span class="fs-4 fw-bold logo-dashboard">Expedientes</span>
    </div>
    <ul class="nav flex-column gap-1 menu-dashboard">
        <li class="nav-item">
            <a class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo ' active'; ?>" href="/expedientes/vistas/dashboard.php">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'carga_expedientes.php') echo ' active'; ?>" href="/expedientes/vistas/carga_expedientes.php">
                <i class="bi bi-archive me-2"></i>Carga de Expediente
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'carga_iniciador.php') echo ' active'; ?>" href="/expedientes/vistas/carga_iniciador.php">
                <i class="bi bi-person-plus me-2"></i>Carga de Iniciador
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'consulta.php') echo ' active'; ?>" href="/expedientes/vistas/consulta.php">
                <i class="bi bi-search me-2"></i>Consulta
            </a>
        </li>
    </ul>
</nav>