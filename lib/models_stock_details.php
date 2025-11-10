<?php
require_once 'lib/db_connect.php';
require_once 'lib/_helpers.php';

$car_id = (int)($_GET['car_id'] ?? 0);
if (!$car_id){
    header("Location: models_stock.php");
    exit;
}
try{
    $stmt = $pdo->prepare("
    SELECT
        cis.*, 
        cm.brand,
        cm.model
    FROM cars_in_stock cis
    JOIN car_models cm ON cis.model_id = cm.id
    WHERE cis.id = ?
    ");
    $stmt->execute([$car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

     if (!$car) {
        header("Location: models_stock.php");
        exit;
    }
    $folder = getModelFolder($car['brand'], $car['model']);
    $mainImage = findModelImage($folder, $car['id']);
    // Получаем похожие авто (другие экземпляры этой же модели)
    $similarStmt = $pdo->prepare("
        SELECT cis.id, cis.price, cis.year, cis.color, cm.brand, cm.model
        FROM cars_in_stock cis
        JOIN car_models cm ON cis.model_id = cm.id
        WHERE cis.model_id = ? AND cis.id != ?
        ORDER BY cis.price DESC
        LIMIT 4
    ");
    $similarStmt->execute([$car['model_id'], $car_id]);
    $similarModels = $similarStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
    die("Ошибка: " . htmlspecialchars($e->getMessage()));
}
?>