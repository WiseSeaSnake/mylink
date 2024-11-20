<?php
global $pdo;
require 'db.php';

$id = $_GET['id'];

// Получаем информацию о платеже, чтобы удалить файл
$stmt = $pdo->prepare("SELECT receipt FROM payments WHERE id = :id");
$stmt->execute(['id' => $id]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

// Удаляем запись из базы данных
$sql = "DELETE FROM payments WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

// Удаляем файл чеки из системы (если он существует)
if ($payment && file_exists($payment['receipt'])) {
    unlink($payment['receipt']);
}

header("Location: payments.php?id=" . $payment['organization_id']);
?>