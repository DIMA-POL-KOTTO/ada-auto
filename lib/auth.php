<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS)); //name='login'
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

//Авторизация пользователя
$sql = 'SELECT id FROM users WHERE login = ? AND password = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);

if($query->rowCount() == 0)
    echo "Такого пользователя нет";
else{
    setcookie('login', $login, time() + 3600 * 24 * 30, "/");
    header('Location: /index.php');
}
   
