<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS)); //name='login'
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));
$phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if(strlen($login) < 3){
    echo "Длина логина меньше 4-х символов";
    exit;
}

//хеширование пароля
$salt = 'b4i23bf*()#$(h93whgfd';
$password = md5($salt.$password);

//DB
require "db_connect.php";
//INSERT
$sql = 'INSERT INTO users(login, email, phone, password) VALUES(?, ?, ?, ?)';
$query = $pdo->prepare($sql);
$query->execute([$login, $email, $phone, $password]);

setcookie('login', $login, time() + 3600 * 24 * 30, "/");
header('Location: /');