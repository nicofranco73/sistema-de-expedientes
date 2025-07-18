<?php
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido');
    }

    // Validar ID
    if (empty($_POST['id'])) {
        throw new Exception('ID de expediente no proporcionado');
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

    // Obtener lugar actual
    $stmt = $db->prepare("SELECT lugar FROM expedientes WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    $lugar_anterior = $stmt->fetchColumn();

    // Actualizar expediente
    $sql = "UPDATE expedientes 
            SET lugar = :lugar,
                extracto = :extracto,
                iniciador = :iniciador
            WHERE id = :id";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':lugar' => $_POST['lugar'],
        ':extracto' => $_POST['extracto'],
        ':iniciador' => $_POST['iniciador'],
        ':id' => $_POST['id']
    ]);

    // Registrar cambio de lugar si cambió
    if ($lugar_anterior !== $_POST['lugar']) {
        // Registrar en historial
        $sql = "INSERT INTO historial_lugares (
                    expediente_id, 
                    lugar_anterior, 
                    lugar_nuevo
                ) VALUES (?, ?, ?)";
                
        $stmt = $db->prepare($sql);
        $stmt->execute([
            $_POST['id'],
            $lugar_anterior,
            $_POST['lugar']
        ]);
    }

    // Confirmar transacción
    $db->commit();

    $_SESSION['mensaje'] = "Expediente actualizado correctamente";
    $_SESSION['tipo_mensaje'] = "success";

} catch (Exception $e) {
    // Revertir cambios si hay error
    if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
    }

    $_SESSION['mensaje'] = "Error al actualizar: " . $e->getMessage();
    $_SESSION['tipo_mensaje'] = "danger";
}

// Redireccionar
header("Location: listar_expedientes.php");
exit;