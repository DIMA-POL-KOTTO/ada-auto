<?php 
require "db_connect.php";
//получение всех моделей
$sql = "
    SELECT 
        cis.*,
        cm.brand, cm.model
    FROM cars_in_stock cis
    JOIN car_models cm ON cis.model_id = cm.id
    ORDER BY cm.brand, cm.model
";
$stmt = $pdo->query($sql);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>