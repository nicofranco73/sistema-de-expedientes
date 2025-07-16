
<?php
/**
 * Procesamiento del formulario de carga de expedientes
 */

// Iniciar sesión y verificar autenticación
session_start();


// Configurar manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Función para sanear inputs
function sanear_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    // Validar método POST
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        throw new Exception("Método no permitido");
    }

    // Validar campos requeridos
    $campos_requeridos = ['numero', 'letra', 'anio', 'fecha_hora_ingreso'];
    foreach ($campos_requeridos as $campo) {
        if (empty($_POST[$campo])) {
            throw new Exception("El campo $campo es requerido");
        }
    }

    // Sanear y validar inputs
    $numero = filter_var($_POST['numero'], FILTER_VALIDATE_INT);
    if (!$numero || $numero < 1) {
        throw new Exception("Número de expediente inválido");
    }

    $letra = sanear_input($_POST['letra']);
    if (!preg_match("/^[A-Z]$/", $letra)) {
        throw new Exception("Letra inválida");
    }

    $anio = filter_var($_POST['anio'], FILTER_VALIDATE_INT);
    if (!$anio || $anio < 1973 || $anio > 2030) {
        throw new Exception("Año inválido");
    }

    $fecha_hora_ingreso = sanear_input($_POST['fecha_hora_ingreso']);
    if (!strtotime($fecha_hora_ingreso)) {
        throw new Exception("Fecha y hora inválidas");
    }

    // Campos opcionales
    $lugar = sanear_input($_POST['lugar'] ?? '');
    $extracto = sanear_input($_POST['extracto'] ?? '');
    $iniciador = sanear_input($_POST['iniciador'] ?? '');

    // Conectar a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Preparar la consulta
    $sql = "INSERT INTO expedientes (numero, letra, anio, fecha_hora_ingreso, lugar, extracto, iniciador) 
            VALUES (:numero, :letra, :anio, :fecha_hora_ingreso, :lugar, :extracto, :iniciador)";
    
    $stmt = $db->prepare($sql);
    
    // Ejecutar la consulta
    $resultado = $stmt->execute([
        ':numero' => $numero,
        ':letra' => $letra,
        ':anio' => $anio,
        ':fecha_hora_ingreso' => $fecha_hora_ingreso,
        ':lugar' => $lugar,
        ':extracto' => $extracto,
        ':iniciador' => $iniciador
    ]);

    if ($resultado) {
        $_SESSION['mensaje'] = "Expediente guardado correctamente";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        throw new Exception("Error al guardar el expediente");
    }

    // Redireccionar
    header("Location: carga_expedientes.php");
    exit;

} catch (PDOException $e) {
    // Error de base de datos
    error_log("Error DB: " . $e->getMessage());
    
    if ($e->getCode() == 23000) { // Error de duplicado
        $_SESSION['mensaje'] = "El expediente ya existe";
    } else {
        $_SESSION['mensaje'] = "Error al procesar la solicitud";
    }
    $_SESSION['tipo_mensaje'] = "danger";
    
} catch (Exception $e) {
    // Otros errores
    error_log("Error: " . $e->getMessage());
    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}

// Redireccionar en caso de error
header("Location: carga_expedientes.php");
exit;