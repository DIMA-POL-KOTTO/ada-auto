<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // Валидация
    if (empty($name) || empty($phone)) {
        echo json_encode(['success' => false, 'message' => 'Заполните все поля']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, phone) VALUES (?, ?)");
        $stmt->execute([$name, $phone]);
        echo json_encode(['success' => true, 'message' => 'Спасибо! Мы скоро свяжемся с вами.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Ошибка отправки. Попробуйте позже.']);
    }
    exit;
}