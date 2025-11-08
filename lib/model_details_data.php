<?php
require_once 'lib/db_connect.php';
require_once 'lib/_helpers.php';

// Получаем параметры из GET запроса
$brand = $_GET['brand'] ?? '';
$model = $_GET['model'] ?? '';

if (empty($brand) || empty($model)) {
    header("Location: models.php");
    exit;
}

try {
    // Получаем основную информацию о модели
    $stmt = $pdo->prepare("
        SELECT 
            cm.*,
            cis.year,
            cis.engine_capacity,
            cis.horse_power,
            cis.fuel_type,
            cis.transmission,
            cis.body_type,
            cis.seats,
            cis.price,
            cis.color,
            cis.vin
        FROM car_models cm
        LEFT JOIN cars_in_stock cis ON cm.id = cis.model_id
        WHERE cm.brand = ? AND cm.model = ?
        LIMIT 1
    ");
    $stmt->execute([$brand, $model]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$car) {
        header("Location: models.php");
        exit;
    }
    
    // Получаем изображения
    $folder = getModelFolder($car['brand'], $car['model']);
    $mainImage = findModelImage($folder);

    
    // Получаем похожие модели
    $similarStmt = $pdo->prepare("
        SELECT cm.brand, cm.model, cis.price, cis.year
        FROM car_models cm
        LEFT JOIN cars_in_stock cis ON cm.id = cis.model_id
        WHERE cm.brand = ? AND cm.model != ? AND cis.id IS NOT NULL
        ORDER BY cis.price DESC
        LIMIT 4
    ");
    $similarStmt->execute([$brand, $model]);
    $similarModels = $similarStmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>