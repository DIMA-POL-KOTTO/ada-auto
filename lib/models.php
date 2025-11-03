<?php
require 'db_connect.php';
$stmt = $pdo->query("SELECT * FROM car_models ORDER BY brand, model");
$models = $stmt->fetchAll();

?>
