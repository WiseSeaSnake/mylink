<?php
$host = 'localhost'; // или ваш хост
$db = 'mylink';
$user = 'root'; // имя пользователя базы данных
$pass = ''; // пароль базы данных

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
}

function getOrgName(int $id):string
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM organizations WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res['name'];
}
?>