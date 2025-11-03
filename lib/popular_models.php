<?php
require 'db_connect.php'; 
$sql = "
    SELECT 
    cm.*, 
    cmp.badge_type,
    cmp.description
    FROM car_models_popular cmp
    JOIN car_models cm ON cmp.car_model_id = cm.id
    WHERE cm.in_stock = 1
    ORDER BY cmp.sort_order ASC, cm.brand ASC
";

$stmt = $pdo->query($sql);
$popular_models = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Подключить models_popular -->