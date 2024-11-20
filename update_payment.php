<?php
global $pdo;
require 'db.php';

$id = $_POST['id'];
$organization_id = $_POST['organization_id'];
$amount = $_POST['amount'];
$date = $_POST['date'];

// Проверяем, загружен ли новый файл
if ($_FILES["receipt"]["name"]) {
    // Загрузка нового файла
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file);
    $sql = "UPDATE payments SET amount = :amount, date = :date, receipt = :receipt WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['amount' => $amount, 'date' => $date, 'receipt' => $target_file, 'id' => $id]);
} else {
    // Если файл не был загружен, просто обновляем другие поля
    $sql = "UPDATE payments SET amount = :amount, date = :date WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['amount' => $amount, 'date' => $date, 'id' => $id]);
}

header("Location: payments.php?id=" . $organization_id);
?>