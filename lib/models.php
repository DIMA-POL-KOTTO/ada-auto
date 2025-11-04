<?php 
require "db_connect.php";
//получение всех моделей
$sql = "
    SELECT brand, model
    FROM car_models
    ORDER BY brand, model
";
$stmt = $pdo->query($sql);
$models = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

