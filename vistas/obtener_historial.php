
<?php
header('Content-Type: application/json');

try {
    // Validar ID
    $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
    if (!$id) {
        throw new Exception('ID inválido');
    }

    // Conectar a la base de datos
    $db = new PDO(
        "mysql:host=localhost;dbname=expedientes;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Consultar historial
    $sql = "SELECT fecha_cambio, lugar_anterior, lugar_nuevo 
            FROM historial_lugares 
            WHERE expediente_id = ? 
            ORDER BY fecha_cambio DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    
    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $historial
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}