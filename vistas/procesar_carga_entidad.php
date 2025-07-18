<?php
session_start();

try {
    // Conectar a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=Iniciadores;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

   

    // Validar email si se proporciona
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("El formato del correo electrónico no es válido");
    }

    // Validar URL de la web si se proporciona
    if (!empty($_POST['web']) && !filter_var($_POST['web'], FILTER_VALIDATE_URL)) {
        throw new Exception("El formato de la URL no es válido");
    }

    // Verificar si ya existe el CUIT (solo si se proporciona)
    if (!empty($_POST['cuit'])) {
        $stmt = $db->prepare("SELECT id FROM persona_juri_entidad WHERE cuit = ?");
        $stmt->execute([$_POST['cuit']]);
        if ($stmt->fetch()) {
            throw new Exception("Ya existe una entidad registrada con ese CUIT");
        }
    }

    // Preparar los datos para insertar
    $datos = [
        'razon_social' => trim($_POST['razon_social'] ?? ''),
        'cuit' => trim($_POST['cuit'] ?? ''),
        'tipo_entidad' => $_POST['tipo_entidad'] ?? null,
        'personeria' => trim($_POST['personeria'] ?? ''),
        'domicilio' => trim($_POST['domicilio'] ?? ''),
        'localidad' => trim($_POST['localidad'] ?? ''),
        'provincia' => trim($_POST['provincia'] ?? ''),
        'tel_fijo' => trim($_POST['tel_fijo'] ?? ''),
        'tel_celular' => trim($_POST['tel_celular'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'web' => trim($_POST['web'] ?? ''),
        'rep_nombre' => trim($_POST['rep_nombre'] ?? ''),
        'rep_cargo' => $_POST['rep_cargo'] ?? null,
        'rep_documento' => trim($_POST['rep_documento'] ?? ''),
        'rep_domicilio' => trim($_POST['rep_domicilio'] ?? ''),
        'rep_tel_fijo' => trim($_POST['rep_tel_fijo'] ?? ''),
        'rep_tel_celular' => trim($_POST['rep_tel_celular'] ?? ''),
        'rep_email' => trim($_POST['rep_email'] ?? '')
    ];

    // Filtrar campos vacíos
    $datos = array_filter($datos, function($valor) {
        return $valor !== '' && $valor !== null;
    });

    // Si no hay datos para insertar
    if (empty($datos)) {
        throw new Exception("Debe proporcionar al menos un dato");
    }

    // Preparar la consulta SQL
    $campos = implode(', ', array_keys($datos));
    $valores = ':' . implode(', :', array_keys($datos));
    
    $sql = "INSERT INTO persona_juri_entidad ($campos) VALUES ($valores)";
    
    // Ejecutar la consulta
    $stmt = $db->prepare($sql);
    $stmt->execute($datos);

    // Mensaje de éxito
    $_SESSION['mensaje'] = "Entidad registrada correctamente";
    $_SESSION['tipo_mensaje'] = "success";

    // Redireccionar
    header("Location: carga_persona_juri_entidad.php");
    exit;

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
    $_SESSION['form_data'] = $_POST;
    header("Location: carga_persona_juri_entidad.php");
    exit;
}