<?php
<?php
session_start();

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido');
}

// Verificar token CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Token de seguridad inválido');
}

// Validar captcha
if (!isset($_POST['captcha']) || !password_verify(strtoupper($_POST['captcha']), $_SESSION['captcha'])) {
    die('Código de verificación incorrecto');
}

// Validar campos
$numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);
$letra = filter_input(INPUT_POST, 'letra', FILTER_SANITIZE_STRING);
$anio = filter_input(INPUT_POST, 'anio', FILTER_VALIDATE_INT);

if (!$numero || !preg_match('/^[A-Z]$/', $letra) || !($anio >= 2000 && $anio <= 2099)) {
    die('Datos inválidos');
}

// Regenerar token y captcha
session_regenerate_id(true);
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Continuar con el procesamiento...