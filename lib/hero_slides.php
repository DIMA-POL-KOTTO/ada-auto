<?php
require 'db_connect.php'; 
$sql = "
    SELECT background_image, description, model_id, brand, model
    FROM hero_models
    JOIN car_models
    ON hero_models.model_id = car_models.id
";

$stmt = $pdo->query($sql);
$hero_slides = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
