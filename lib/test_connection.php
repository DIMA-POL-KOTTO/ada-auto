<?php
echo "Проверка подключения к MySQL...<br>";

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'ada_auto';

try {
    // Пробуем подключиться без указания базы данных
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Успешное подключение к MySQL!<br>";
    
    // Проверяем существование базы данных
    $result = $pdo->query("SHOW DATABASES LIKE '$dbname'");
    if ($result->rowCount() > 0) {
        echo "✅ База данных '$dbname' существует!<br>";
    } else {
        echo "❌ База данных '$dbname' не найдена<br>";
        echo "Создаем базу данных...<br>";
        $pdo->exec("CREATE DATABASE $dbname");
        echo "✅ База данных '$dbname' создана!<br>";
    }
    
} catch (PDOException $e) {
    echo "❌ Ошибка подключения: " . $e->getMessage() . "<br>";
    echo "Проверьте:<br>";
    echo "- Запущен ли MySQL в OpenServer<br>";
    echo "- Пароль MySQL (обычно пустой в OpenServer)<br>";
}
?>