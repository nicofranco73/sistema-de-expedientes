
<?php
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Validar datos
    $expediente_id = filter_var($_POST['expediente_id'] ?? null, FILTER_VALIDATE_INT);
    $lugar_anterior = trim($_POST['lugar_anterior'] ?? '');
    $lugar_nuevo = trim($_POST['lugar_nuevo'] ?? '');
    $fecha_hora = $_POST['fecha_hora'] ?? '';

    if (!$expediente_id || !$lugar_anterior || !$lugar_nuevo || !$fecha_hora) {
        throw new Exception('Todos los campos son requeridos');
    }

    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Iniciar transacción
    $db->beginTransaction();

    // Registrar en historial
    $sql = "INSERT INTO historial_lugares (
                expediente_id, 
                lugar_anterior, 
                lugar_nuevo, 
                fecha_cambio
            ) VALUES (?, ?, ?, ?)";
            
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $expediente_id,
        $lugar_anterior,
        $lugar_nuevo,
        $fecha_hora
    ]);

    // Actualizar lugar actual del expediente
    $sql = "UPDATE expedientes SET lugar = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$lugar_nuevo, $expediente_id]);

    // Confirmar transacción
    $db->commit();

    $_SESSION['mensaje'] = "Pase registrado correctamente";
    $_SESSION['tipo_mensaje'] = "success";

} catch (Exception $e) {
    if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
    }
    $_SESSION['mensaje'] = "Error al registrar el pase: " . $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}

header("Location: pases_expediente.php?id=" . $expediente_id);
exit;