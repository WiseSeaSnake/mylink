<?php

global $pdo;
require "../db.php";
try {
 //   $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $id = $_POST['id'] ?? null;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $avatar = $_POST['avatar'];
    $role = $_POST['role'];
    $f = $_POST['f'];
    $i = $_POST['i'];
    $o = $_POST['o'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $wathapp = $_POST['wathapp'];
    $telegramm = $_POST['telegramm'];

    // Обработка загрузки аватара
    $avatar = null;
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $target_dir = "avatars/";
        $avatar = $target_dir . basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
    }

    // Если ID существует, выполняем обновление
    if ($id) {
        $sql = "UPDATE users SET username = :username, role = :role, f = :f, i = :i, o = :o, mail = :mail, phone = :phone, wathapp = :wathapp, telegramm = :telegramm" .
                  ($avatar ? ", avatar = :avatar" : "") . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        // Привязка параметров
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':f', $f);
        $stmt->bindParam(':i', $i);
        $stmt->bindParam(':o', $o);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':wathapp', $wathapp);
        $stmt->bindParam(':telegramm', $telegramm);
        if ($avatar) {
            $stmt->bindParam(':avatar', $avatar);
        }
        $stmt->bindParam(':id', $id);
    } else {
        // Если ID нет, то это добавление нового пользователя
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role, avatar, f, i, o, mail, phone, wathapp, telegramm) VALUES (:username, :password, :role, :avatar, :f, :i, :o, :mail, :phone, :wathapp, :telegramm)";
        $stmt = $pdo->prepare($sql);

        // Привязка параметров
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':avatar', $avatar);
        $stmt->bindParam(':f', $f);
        $stmt->bindParam(':i', $i);
        $stmt->bindParam(':o', $o);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':wathapp', $wathapp);
        $stmt->bindParam(':telegramm', $telegramm);
    }

    // Выполнение запроса
    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        echo "Ошибка: " . $stmt->errorInfo()[2];
    }
}

$pdo = null; // Закрываем соединение