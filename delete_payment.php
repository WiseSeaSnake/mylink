<?php
global $pdo;
require 'db.php';

$pay_id = $_GET['pay_id'];

// Получаем информацию о платеже, чтобы удалить файл
$stmt = $pdo->prepare("SELECT receipt FROM payments WHERE id = :id");
$stmt->execute(['id' => $pay_id]);
$payment = $stmt->fetch(PDO::FETCH_ASSOC);

// Удаляем запись из базы данных
$sql = "DELETE FROM payments WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $pay_id]);

// Удаляем файл чеки из системы (если он существует)
if ($payment && file_exists($payment['receipt'])) {
    unlink($payment['receipt']);
}

header("Location: payments.php?org_id=" . $payment['organization_id']);
?>