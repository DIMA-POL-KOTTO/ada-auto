<?php
// Удаляем куки
setcookie('login', '', time() - 3600, '/');

// Перенаправляем на главную страницу
header('Location: /index.php');