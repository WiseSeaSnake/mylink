<?php
$host = 'localhost'; // или ваш хост
$db = 'payment_management';
$user = 'root'; // имя пользователя базы данных
$pass = ''; // пароль базы данных

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}
?>