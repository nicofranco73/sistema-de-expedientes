
<?php
header('Content-Type: application/json');

try {
    $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
    if (!$id) {
        throw new Exception('ID inválido');
    }

    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $sql = "SELECT 
                DATE_FORMAT(fecha_cambio, '%d/%m/%Y %H:%i') as fecha_formateada,
                lugar_anterior,
                lugar_nuevo
            FROM historial_lugares 
            WHERE expediente_id = ?
            ORDER BY fecha_cambio DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $historial]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}