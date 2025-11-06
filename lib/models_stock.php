<?php
require_once 'lib/db_connect.php';

// Все бренды для селекта
$all_brands = $pdo->query("SELECT DISTINCT brand FROM car_models ORDER BY brand")->fetchAll(PDO::FETCH_COLUMN);

// Сборка условий
$conditions = [];
$params = [];

// Поиск по названию
if (!empty($_GET['search'])) {
    $conditions[] = "(cm.brand LIKE ? OR cm.model LIKE ?)";
    $search = '%' . ($_GET['search']) . '%';
    $params[] = $search;
    $params[] = $search;
}

// Марка
if (!empty($_GET['brand'])) {
    $conditions[] = "cm.brand = ?";
    $params[] = $_GET['brand'];
}

// Модель
if (!empty($_GET['model'])) {
    $conditions[] = "cm.model = ?";
    $params[] = $_GET['model'];
}

// Топливо
if (!empty($_GET['fuel'])) {
    $conditions[] = "cis.fuel_type = ?";
    $params[] = $_GET['fuel'];
}

// Трансмиссия
if (!empty($_GET['transmission'])) {
    $conditions[] = "cis.transmission = ?";
    $params[] = $_GET['transmission'];
}

// Кузов
if (!empty($_GET['body_type'])) {
    $conditions[] = "cis.body_type = ?";
    $params[] = $_GET['body_type'];
}

// Цена
if (!empty($_GET['price'])) {
    $conditions[] = "cis.price <= ?";
    $params[] = (int)$_GET['price'];
}

$where = $conditions ? 'WHERE ' . implode(' AND ', $conditions) : '';

// Основной запрос
$sql = "
    SELECT cis.*, cm.brand, cm.model
    FROM cars_in_stock cis
    JOIN car_models cm ON cis.model_id = cm.id
    $where
    ORDER BY cm.brand, cm.model
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>