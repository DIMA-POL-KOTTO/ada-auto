<?php
require 'db_connect.php'; 
$sql = "
    SELECT 
    cis.*,
        cm.brand,
        cm.model,
        cp.badge_type,
        cp.description
    FROM cars_popular cp
    JOIN cars_in_stock cis ON cp.car_in_stock_id = cis.id
    JOIN car_models cm ON cis.model_id = cm.id
    ORDER BY cp.sort_order ASC
";

$stmt = $pdo->query($sql);
$popular_models = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
