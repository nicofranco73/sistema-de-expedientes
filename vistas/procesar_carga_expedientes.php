<?php
/**
 * Procesamiento de carga de expedientes
 */

session_start();

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Función para sanear inputs
function sanear_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

try {
    // Validar método POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Método no permitido");
    }

    // Validar campos requeridos
    $campos_requeridos = [
        'numero', 'letra', 'folio', 'libro', 'anio', 
        'fecha_hora_ingreso', 'lugar', 'extracto', 'iniciador'
    ];

    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            throw new Exception("Todos los campos son obligatorios");
        }
    }

    // Validar longitud del extracto
    if (strlen($_POST['extracto']) > 300) {
        throw new Exception("El extracto no puede superar los 300 caracteres");
    }

    // Conectar a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Iniciar transacción
    $db->beginTransaction();

    // Preparar datos
    $data = [
        'numero' => filter_var($_POST['numero'], FILTER_VALIDATE_INT),
        'letra' => sanear_input($_POST['letra']),
        'folio' => filter_var($_POST['folio'], FILTER_VALIDATE_INT),
        'libro' => filter_var($_POST['libro'], FILTER_VALIDATE_INT),
        'anio' => filter_var($_POST['anio'], FILTER_VALIDATE_INT),
        'fecha_hora_ingreso' => sanear_input($_POST['fecha_hora_ingreso']),
        'lugar' => sanear_input($_POST['lugar'] ?? ''),
        'extracto' => sanear_input($_POST['extracto'] ?? ''),
        'iniciador' => sanear_input($_POST['iniciador'] ?? '')
    ];

    // Validar datos
    if (!$data['numero'] || !$data['folio'] || !$data['libro'] || !$data['anio']) {
        throw new Exception("Datos numéricos inválidos");
    }

    if (!preg_match('/^[A-Z]$/', $data['letra'])) {
        throw new Exception("Letra inválida");
    }

    // Insertar expediente
    $sql = "INSERT INTO expedientes (
                numero, letra, folio, libro, anio, 
                fecha_hora_ingreso, lugar, extracto, iniciador
            ) VALUES (
                :numero, :letra, :folio, :libro, :anio,
                :fecha_hora_ingreso, :lugar, :extracto, :iniciador
            )";

    $stmt = $db->prepare($sql);
    $stmt->execute($data);

    // Confirmar transacción
    $db->commit();

    $_SESSION['mensaje'] = "Expediente guardado correctamente";
    $_SESSION['tipo_mensaje'] = "success";

} catch (PDOException $e) {
    // Revertir transacción
    if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
    }

    error_log("Error DB: " . $e->getMessage());
    
    if ($e->getCode() == 23000) { // Error de duplicado
        $_SESSION['mensaje'] = "El expediente ya existe en el sistema";
    } else {
        $_SESSION['mensaje'] = "Error al guardar el expediente";
    }
    $_SESSION['tipo_mensaje'] = "danger";

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}

// Redireccionar
header("Location: carga_expedientes.php");
exit;